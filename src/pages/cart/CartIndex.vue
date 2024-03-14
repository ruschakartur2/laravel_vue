<template>
    <AuthenticatedLayout>
        <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md">
            <h2 class="text-2xl font-semibold mb-4">My Cart</h2>
            <!-- Cart summary -->
            <div class="mb-4 bg-white p-4 rounded-lg shadow-md">
                <p class="text-lg font-medium mb-2">Total courses count: {{ store.cartData.total_count ?? 0 }}</p>
                <p class="text-lg font-medium">Total courses price: ${{ store.cartData.total_price ?? 0 }}</p>
            </div>
            <!-- List of courses in the cart -->
            <div v-if="store.cartData.courses.length > 0">
                <div v-for="course in store.cartData.courses" :key="course.id" class="bg-white rounded-lg shadow-md mb-4">
                    <div class="flex items-center justify-between p-4">
                        <div class="flex items-center space-x-4">
                            <span class="font-medium text-gray-800">{{ course.name }}</span>
                            <span class="text-gray-500">${{ course.price }}</span>
                        </div>
                        <button @click="removeFromCart(course.id)" class="text-red-600 hover:text-red-800 focus:outline-none">
                            Remove
                        </button>
                    </div>
                </div>
            </div>
            <!-- Show a message if the cart is empty -->
            <p v-else class="text-gray-700">No courses in the cart.</p>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue'
import { useCart } from '@/stores/cart'

const store = useCart()

onMounted(store.getData)

const processing = ref(false)

const removeFromCart = async (courseId) => {
    processing.value = true
    try {
        await store.removeCourse(courseId)
    } catch (error) {
        console.error('Error removing course from cart:', error)
    } finally {
        processing.value = false
    }
}
</script>

<style scoped>
/* Add any scoped styles here */
</style>
