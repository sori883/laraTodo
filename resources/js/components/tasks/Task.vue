<template>
<li class="nav-item border-bottom">
    <div class="d-flex justify-content-between pt-3">
        <span class="task-title">
            {{ task.title }}
        </span>
        <div>
            <span>
                <i class="fas fa-edit"></i>
            </span>
            <span>
                <i class="fas fa-trash text-danger"></i>
            </span>
        </div>
    </div>

    <div class="mt-2 mb-1">
        <small><i class="fas fa-calendar-day d-inline mr-1"></i>{{ task.limit_at }}</small>
    </div>
</li>
</template>

<script>
export default {
    props: {
        task: {
            type: Object,
            required: true
        }
    }
}
</script>
