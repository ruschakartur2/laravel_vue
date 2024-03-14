<template>
    <AuthenticatedLayout>
        <div class="relative overflow-hidden overflow-x-auto min-w-full">
            <!-- Notification for success action -->
            <div v-if="successMessage"
                 class="absolute top-0 right-0 mt-4 mr-4 px-4 py-2 bg-green-500 text-white rounded-md shadow">
                {{ successMessage }}
            </div>
            <!-- Notification for error -->
            <div v-if="errorMessage"
                 class="absolute top-0 right-0 mt-4 mr-4 px-4 py-2 bg-red-500 text-white rounded-md shadow">
                {{ errorMessage }}
            </div>
            <table class="min-w-full border divide-y divide-gray-200">
                <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50">
                        <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 uppercase">Name</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span class="text-xs font-medium tracking-wider leading-4 text-gray-500 uppercase">Price</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span
                            class="text-xs font-medium tracking-wider leading-4 text-gray-500 uppercase">Languages</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                        <span
                            class="text-xs font-medium tracking-wider leading-4 text-gray-500 uppercase">Actions</span>
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                <template v-for="course in store.courseData" :key="course.id">
                    <tr class="bg-white hover:bg-gray-100">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ course.name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">${{ course.price }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-wrap">
                  <span v-for="(language, index) in course.languages" :key="language.id">
                    <span class="mr-1">{{ language.name }}</span>
                    <span v-if="index !== course.languages.length - 1" class="mr-1">,</span>
                  </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button v-if="isCourseInCart(course.id)" @click="removeFromCart(course.id)"
                                    :disabled="processing"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150">
                                <span v-if="processing" class="mr-2">Removing...</span>
                                <span v-else>Remove from Cart</span>
                            </button>
                            <button v-else @click="courseToCart(course.id)" :disabled="processing"
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition ease-in-out duration-150">
                                <span v-if="processing" class="mr-2">Processing...</span>
                                <span v-else>Add to Cart</span>
                            </button>
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import AuthenticatedLayout from '@/layouts/AuthenticatedLayout.vue'
import { useCourses } from '@/stores/course'
import { useCart } from '@/stores/cart'

const store = useCourses()
const cartStore = useCart()

onMounted(store.getData)

const processing = ref(false)
const successMessage = ref(null)
const errorMessage = ref(null)

const isCourseInCart = (courseId) => {
    return cartStore.cartData.courses.some(course => course.id === courseId)
}

const courseToCart = async (courseId) => {
    processing.value = true
    try {
        successMessage.value = await cartStore.addCourse(courseId)
    } catch (error) {
        errorMessage.value = error
    } finally {
        processing.value = false
    }
}

const removeFromCart = async (courseId) => {
    processing.value = true
    try {
        successMessage.value = await cartStore.removeCourse(courseId)
    } catch (error) {
        errorMessage.value = error
    } finally {
        processing.value = false
    }
}
</script>

<style scoped>
/* Add any scoped styles here */
</style>
