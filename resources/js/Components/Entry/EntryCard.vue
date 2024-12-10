<script setup>
import { ref } from 'vue'
import CancelModal from './CancelModal.vue'

const props = defineProps({
    entry: {
        type: Object,
        required: true
    }
})

const showCancelModal = ref(false)
</script>

<template>
    <div class="text-center flex flex-col border-x border-b">
        <div class="flex">
            <div class="w-32 border-r">申込日</div>
            <div class="flex-1">{{ entry.entered_at.slice(0, 10).replace(/-/g, "/") }}</div>
        </div>
        <div class="flex">
            <div class="w-32 border-r">案件名</div>
            <div class="flex-1">{{ entry.project_title }}</div>
        </div>
        <div class="flex">
            <div class="w-32 border-r">種別</div>
            <div class="flex-1">応募</div>
        </div>
        <div class="flex">
            <div class="w-32 border-r">取消</div>
            <div class="text-center flex-1 justify-center items-center">
                <button v-if="entry.status_id == 1"
                    type="button"
                    @click="showCancelModal = true"
                    class="rounded text-white bg-blue-500 hover:bg-blue-400 text-lg font-bold py-2 w-48"
                >
                    エントリーを取り消す
                </button>
                <p v-else-if="entry.status_id == 2" class="text-red-500">エントリー取消済</p>
            </div>
        </div>
    </div>

    <CancelModal
        :show="showCancelModal"
        :entry-id="entry.id"
        @close="showCancelModal = false"
        @cancel="entry.status_id = 2"
    />
</template>