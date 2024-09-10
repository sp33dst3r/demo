<script setup>
import usePaginator from 'vue-use-paginator'

const props = defineProps({
    currentPage: {
        type: Number,
        default: 1
    },
    total: {
        type: Number,
        default: 0
    },
    perPage: {
        type: Number,
        default: 10
    },
    lastPage: Number

})

const emit = defineEmits(['pageChanged'])

const paginator = usePaginator({
    pageSize: props.perPage,
    numItems: props.total,
    numButtons: 5,
    page: props.currentPage
});

const setPage = (page) => {
    paginator.page.value = page
    emit('pageChanged', page)
}

const goNext = () => {
    setPage(++paginator.page.value)
}

const goStart = () => {
    setPage(1)
}

const goPrev = () => {
    setPage(--paginator.page.value)
}

const goEnd = () => {
    setPage(props.lastPage)
}

</script>

<template>
    <ul class="paginator">
        <li class="control" :class="{ disabled: !paginator.hasPrev.value }" @click="goStart">
            {{ '<<' }} </li>
        <li class="control" :class="{ disabled: !paginator.hasPrev.value }" @click="goPrev">
            {{ '<' }} </li>
        <li v-for="(button, idx) in paginator.buttons.value" :key="idx" :class="{ 'current-page': button.active }"
            @click="setPage(button.page)">
            {{ button.ellipsis ? '...' : button.page }}
        </li>
        <li class="control" :class="{ disabled: !paginator.hasNext.value }" @click="goNext">
            {{ '>' }}
        </li>
        <li class="control" :class="{ disabled: !paginator.hasNext.value }" @click="goEnd">
            {{ '>>' }}
        </li>
    </ul>
</template>