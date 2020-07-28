<template>
<transition name="fade">
    <li class="list-group-item">
        <div class="d-flex justify-content-between">
            <span>直打ちタスク</span>
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
            <small><i class="fas fa-calendar-day d-inline mr-1"></i>直打ちタスク</small>
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
        }
    },
    data() {
        return {
            isDestroy: true,
        }
    },
    methods: {
    },
}
</script>
