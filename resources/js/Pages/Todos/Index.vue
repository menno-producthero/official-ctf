<template>
    <div class="max-w-md mx-auto p-4">
        <h1 class="text-2xl mb-4">Todo List</h1>

        <form @submit.prevent="submit">
            <input
                v-model="form.title"
                type="text"
                placeholder="New todo"
                class="border p-2 rounded w-full mb-2"
            />
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                Add
            </button>
        </form>

        <ul class="mt-4">
            <li
                v-for="todo in todos"
                :key="todo.id"
                class="flex items-center justify-between border-b py-2"
            >
                <div
                    :class="{ 'line-through text-gray-500': todo.completed }"
                    @click="toggle(todo)"
                    class="cursor-pointer"
                >
                    title: {{ todo.title }}
                    <br/>
                    description: {{ todo.description }}
                </div>
                <button @click="destroy(todo)" class="text-red-500">x</button>
            </li>
        </ul>

        <input
            v-model="encodedTitle"
            type="text"
            placeholder="Enter hidden code"
            class="border p-2 rounded w-full mt-4"
        />
        <button
            @click="revealHiddenFlag"
            class="bg-green-500 text-white px-4 py-2 rounded mt-2"
        >
            Reveal Hidden Flag
        </button>

        <div v-if="decodedFlag" class="mt-2 p-2 border rounded bg-gray-100">
            Hidden Flag: {{ decodedFlag }}
        </div>
    </div>
</template>

<script setup>
import {ref, onMounted, onUnmounted} from 'vue'
import {useForm, router} from '@inertiajs/vue3'

var codeOne = "ZmxhZ3tjYW4nd"
var codeTwo = "F9zdG9wX3RoaXN9=="

const props = defineProps({
    todos: Array,
})

const form = useForm({
    title: '',
})

const encodedTitle = ref('')
const decodedFlag = ref(null)

const reloadTodos = () => {
    router.reload({preserveScroll: true, preserveState: true})
}

const submit = () => {
    form.post('/todos', {
        onSuccess: () => {
            form.reset('title')
            reloadTodos()
        },
    })
}

const toggle = (todo) => {
    router.patch(`/todos/${todo.id}`, {}, {
        onSuccess: () => reloadTodos()
    })
}

const destroy = (todo) => {
    router.delete(`/todos/${todo.id}`, {
        onSuccess: () => reloadTodos()
    })
}

const revealHiddenFlag = () => {
    if (!encodedTitle.value) {
        decodedFlag.value = 'Please paste the encoded string.'
        return
    }

    const encoded = encodedTitle.value
    let binary = ''
    for (const char of encoded) {
        if (char === ' ') binary += '0'
        else if (char === '\t') binary += '1'
        else {
            // ignore other chars or consider invalid input
        }
    }

    let flag = ''
    for (let i = 0; i < binary.length; i += 8) {
        const byte = binary.slice(i, i + 8)
        if (byte.length < 8) continue
        flag += String.fromCharCode(parseInt(byte, 2))
    }

    decodedFlag.value = flag || 'Failed to decode flag.'
}

const konamiCode = [
    'ArrowUp', 'ArrowUp',
    'ArrowDown', 'ArrowDown',
]
let position = 0

function onKeydown(event) {
    if (event.key === konamiCode[position]) {
        position++
        if (position === konamiCode.length) {
            if (typeof cornify_add === 'function') {
                cornify_add()
            } else {
                alert('✨ Konami Activated, but cornify.js not loaded. ✨')
            }
            position = 0
        }
    } else {
        position = 0
    }
}

onMounted(() => window.addEventListener('keydown', onKeydown))
onUnmounted(() => window.removeEventListener('keydown', onKeydown))
</script>
