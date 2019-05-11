export const Validator = (data) => {
    return {
        merchant_safe_id: [
            {
                type: 'number',
                required: true,
                trigger: 'blur',
                message: '必须选择保险'
            }
        ]
    }
};