export const Validator = (data) => {
    return {
        images: [{
            required: false,
            type: 'array',
            trigger: 'blur'
        }]
    }
}