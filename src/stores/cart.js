import axios from '@/lib/axios'
import { useStorage } from '@vueuse/core'
import { defineStore, acceptHMRUpdate } from 'pinia'

export const useCart = defineStore('carts', {
    state: () => ({
        cartData: useStorage('cartData', []),
    }),

    getters: {
        hasCartData: state => Object.keys(state.cartData).length > 0,
    },

    actions: {
        getData () {
            axios
                .get('/api/carts    ')
                .then(response => {
                    this.cartData = response.data.data
                })
                .catch(error => {
                    // Обробка помилок
                })
        },
        addCourse (course_id) {
            return axios
                .post('/api/carts', { course_id: course_id })
                .then((response) => {
                    this.getData()
                    return response.data.message
                })
                .catch(error => {
                    return error.data.message
                })
        },
        removeCourse (course_id) {
            return axios
                .delete(`/api/carts/${course_id}`)
                .then((response) => {
                    this.getData()
                    return response.data.message
                })
                .catch(error => {
                    return error.data.message
                })
        },
    },
})

if (import.meta.hot) {
    import.meta.hot.accept(acceptHMRUpdate(useCart, import.meta.hot))
}
