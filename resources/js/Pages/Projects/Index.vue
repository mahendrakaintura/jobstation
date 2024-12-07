<script setup>
import { Head, usePage } from '@inertiajs/vue3'
import { ref, watch, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import ProjectCard from '@/Components/Project/ProjectCard.vue'

const page = usePage()

onMounted(() => {
    if (page.props.alert?.message) {
        window.alert(page.props.alert.message);
    }
});

const props = defineProps({
    projects: {
        type: Object,
        required: true
    },
    filters: {
        type: Object,
        required: true
    },
    filterOptions: {
        type: Object,
        required: true
    }
})

const selectedArea = ref(props.filters.area || '')
const selectedPrice = ref(props.filters.display_price || '')
const selectedLanguage = ref(props.filters.language || '')
const selectedStartDate = ref(props.filters.start || '')
const selectedSort = ref(props.filters.sort || 'latest')
const isSearching = ref(false)

const handleSearch = () => {
    isSearching.value = true
    router.get('/', {
        area: selectedArea.value,
        display_price: selectedPrice.value,
        language: selectedLanguage.value,
        start: selectedStartDate.value,
        sort: selectedSort.value
    }, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => { isSearching.value = false },
        onError: () => { isSearching.value = false }
    })
}

const handleSort = (sortValue) => {
    selectedSort.value = sortValue
    handleSearch()
}

const handlePageChange = (url) => {
    isSearching.value = true
    router.get(url, {}, {
        preserveState: true,
        preserveScroll: false,
        onSuccess: () => {
            isSearching.value = false
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            })
        },
        onError: () => { isSearching.value = false }
    })
}

watch(
    () => page.props.flash?.alert,
    (newAlert) => {
        if (newAlert?.message) {
            window.alert(newAlert.message);
        }
    },
    { immediate: true }
);
</script>

<template>
    <Head title="案件一覧" />
    <AppLayout>
        <template #main>
            <div class="front-content sm:flex w-full p-10">
                <div class="overflow-hidden text-center sm:w-1/3">
                    <div class="rounded-md bg-white p-3 sticky top-14">
                    <div class="space-y-4">
                        <div class="flex items-center whitespace-nowrap">
                            <label class="w-24 text-right mr-4">エリア</label>
                            <select v-model="selectedArea"
                                class="flex-1 rounded-md border-gray-300 focus:border-blue-500 text-sm py-2 px-3"
                                :disabled="isSearching">
                                <option value="">選択してください</option>
                                <option v-for="(label, value) in filterOptions.areas" :key="value" :value="value">
                                    {{ label }}
                                </option>
                            </select>
                        </div>
                        <div class="flex items-center whitespace-nowrap">
                            <label class="w-24 text-right mr-4">単価</label>
                            <select v-model="selectedPrice"
                                class="flex-1 rounded-md border-gray-300 focus:border-blue-500 text-sm py-2 px-3"
                                :disabled="isSearching">
                                <option value="">選択してください</option>
                                <option v-for="(label, value) in filterOptions.prices" :key="value" :value="value">
                                    {{ label }}
                                </option>
                            </select>
                        </div>
                        <div class="flex items-center whitespace-nowrap">
                            <label class="w-24 text-right mr-4">言語</label>
                            <select v-model="selectedLanguage"
                                class="flex-1 rounded-md border-gray-300 focus:border-blue-500 text-sm py-2 px-3"
                                :disabled="isSearching">
                                <option value="">選択してください</option>
                                <optgroup label="フロントエンド">
                                    <option v-for="(label, index) in filterOptions.languages['フロントエンド']"
                                        :key="`frontend-${index}`" :value="`f${index - 1}`">
                                        {{ label }}
                                    </option>
                                </optgroup>
                                <optgroup label="バックエンド">
                                    <option v-for="(label, index) in filterOptions.languages['バックエンド']"
                                        :key="`backend-${index}`" :value="`b${index - 1}`">
                                        {{ label }}
                                    </option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="flex items-center whitespace-nowrap">
                            <label class="w-24 text-right mr-4">稼働時期</label>
                            <select v-model="selectedStartDate"
                                class="flex-1 rounded-md border-gray-300 focus:border-blue-500 text-sm py-2 px-3"
                                :disabled="isSearching">
                                <option value="">選択してください</option>
                                <option v-for="(label, value) in filterOptions.start_dates" :key="value"
                                    :value="value">
                                    {{ label }}
                                </option>
                            </select>
                        </div>
                        <div class="mt-6">
                            <button type="button" @click="handleSearch"
                                class="w-full rounded bg-blue-500 hover:bg-blue-400 text-white text-lg font-bold py-2"
                                :disabled="isSearching">
                                <span v-if="isSearching">検索中...</span>
                                <span v-else>検索</span>
                            </button>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="mx-auto sm:w-2/3 h-full sm:pl-5">
                    <div class="flex justify-end mb-4 space-x-2">
                        <button @click="handleSort('latest')" class="px-4 py-2 rounded" :class="{
                            'bg-blue-500 text-white': selectedSort === 'latest',
                            'bg-gray-200 hover:bg-gray-300': selectedSort !== 'latest'
                        }">
                            新着順
                        </button>
                        <button @click="handleSort('display_price_high')" class="px-4 py-2 rounded" :class="{
                            'bg-blue-500 text-white': selectedSort === 'display_price_high',
                            'bg-gray-200 hover:bg-gray-300': selectedSort !== 'display_price_high'
                        }">
                            単価の高い順
                        </button>
                    </div>
                    <div v-if="projects.data.length === 0" class="bg-white rounded-lg p-6 text-center">
                        <p class="text-gray-600">検索条件に該当する案件が見つかりませんでした。</p>
                        <p class="text-gray-600 mt-2">条件を変更して再度検索してください。</p>
                    </div>
                    <div v-else class="space-y-5">
                        <div v-for="project in projects.data" :key="project.id">
                            <ProjectCard :project="project" />
                        </div>
                    </div>
                    <div class="mt-6">
                        <template v-if="projects.links && projects.links.length > 3">
                            <div class="flex justify-center gap-2">
                                <template v-for="(link, index) in projects.links" :key="index">
                                    <div v-if="link.url" @click="handlePageChange(link.url)"
                                        class="px-3 py-1 rounded cursor-pointer" :class="{
                                            'bg-blue-500 text-white': link.active,
                                            'bg-gray-200 hover:bg-gray-300': !link.active
                                        }" v-html="link.label"></div>
                                    <div v-else class="px-3 py-1 text-gray-400" v-html="link.label"></div>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>