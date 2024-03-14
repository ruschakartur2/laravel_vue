import axios from '@/lib/axios'
import { useStorage } from '@vueuse/core'
import { defineStore, acceptHMRUpdate } from 'pinia'

export const useCourses = defineStore('courses', {
    state: () => ({
        courseData: useStorage('courseData', []),
    }),

    getters: {
    },

    actions: {
        getData() {
            axios
                .get('/api/courses')
                .then(response => {
                    this.courseData = response.data.data
                })
                .catch(error => {
                    if (error.response.status !== 409) throw error
                })
        },

    },
})

if (import.meta.hot) {
    import.meta.hot.accept(acceptHMRUpdate(useCourses, import.meta.hot))
}
