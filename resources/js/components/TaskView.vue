<template>
    <transition name="fade">
        <li class="list-group-item" v-if="isDestroy">
            <div class="d-flex justify-content-between">
                <span>{{ task.title }}</span>
                <div>
                    <span>
                        <i class="fas fa-edit" @click="taskEdit"></i>
                    </span>
                    <span>
                        <i class="fas fa-trash text-danger" @click="taskDestroy"></i>
                    </span>
                </div>
            </div>

            <div>
                <small><i class="fas fa-calendar-day d-inline mr-1"></i>{{ task.limit_at }}</small>
            </div>
        </li>
    </transition>
</template>

<script>
    export default {
        props: {
            task: {
                type: Object,
                required: true,
            },
            endpoint: {
                type: String,
                required: true,
            },
        },
        data() {
            return {
                isDestroy: true,
            }
        },
        methods: {
            taskDestroy() {
                this.isDestroy = !this.isDestroy
                this.destroy()
            },
            taskEdit() {

            },
            async destroy() {
                const response = await axios.delete(this.endpoint)
            },
        },
    }
</script>
