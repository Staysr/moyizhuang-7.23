export default {
    state: {
        data: {},
        lock: {}
    },
    getters: {
        cache: (state) => (key) => {
            return state.data[key] || []
        },
        cacheLock: (state) => (key) => {
            return state.lock[key] || false
        }
    },
    mutations: {
        setCacheData(state, cache) {
            state.data[cache.key] = cache.data
        },
        setCacheLock(state, key) {
            state.lock[key] = true
        }
    }
}
