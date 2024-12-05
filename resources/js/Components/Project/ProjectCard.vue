<script setup>
import { ref } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import axios from 'axios'
import EntryModal from '@/Components/Entry/EntryModal.vue'

const props = defineProps({
    project: {
        type: Object,
        required: true
    }
})

const page = usePage()
const isFavorite = ref(props.project.is_favorited ?? false)

const toggleFavorite = async () => {
    try {
        if (isFavorite.value) {
            await axios.delete(`/favorites/${props.project.id}`)
        } else {
            await axios.post(`/favorites/${props.project.id}`)
        }
        isFavorite.value = !isFavorite.value
    } catch (error) {
        console.error('お気に入り操作に失敗しました', error)
    }
}

const showEntryModal = ref(false)
</script>

<template>
    <div class="rounded-md border border-gray-300 bg-white p-10">
        <div class="p-3">
            <div class="flex justify-between items-center">
                <p class="rounded-md bg-yellow-500 text-xl w-20 px-5 py-2">新着</p>
                <button 
                    v-if="page.props.auth.user"
                    type="button"
                    @click="toggleFavorite"
                    class="rounded text-black hover:bg-gray-400 text-lg font-bold px-5 py-1"
                    :class="isFavorite ? 'bg-yellow-200' : 'bg-gray-300'"
                >
                    {{ isFavorite ? 'お気に入り済み' : 'お気に入りへ追加' }}
                </button>
            </div>

            <h2 class="mt-3 p-2">{{ project.title }}</h2>
            <p class="text-xl font-bold p-2">
                ◎ エリア：{{ project.workplace }}　
                ◎ リモート：{{ project.remote ? 'あり' : 'なし' }}　
                ◎ 国籍：{{ project.is_only_japanese ? '日本人のみ' : '不問' }}
            </p>
            <p class="text-xl font-bold p-2">■ 月単価：{{ project.display_price }}</p>
            <p class="text-xl font-bold p-2">■ スキル：{{ project.skills }}</p>
            <p class="text-xl font-bold p-2">
                ■ 概要・内容：
                <span class="text-base">{{ project.summary }}</span>
            </p>
        </div>

        <div class="text-center flex justify-center items-center space-x-4">
            <Link
                :href="route('projects.show', project.id)"
                class="rounded bg-blue-500 hover:bg-blue-400 text-white text-lg font-bold px-8 py-2 w-48"
            >
                詳細
            </Link>
            <button
                type="button"
                @click="showEntryModal = true"
                class="rounded text-white bg-blue-500 hover:bg-blue-400 text-lg font-bold py-2 w-48"
            >
                エントリー
            </button>
        </div>
    </div>

    <EntryModal
    :show="showEntryModal"
    :project-id="project.id"
    @close="showEntryModal = false"
/>
</template>