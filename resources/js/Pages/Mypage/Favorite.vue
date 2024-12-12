<script setup>
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import ProjectCard from '@/Components/Project/ProjectCard.vue'

const props = defineProps({
    projects: {
        type: Object,
        required: true
    }
})

const showingProjects = ref(props.projects)
const checkedIds = ref([]);

function updateCheckedIds({ id, checked }) {
    if (checked) {
        if (!checkedIds.value.includes(id)) {
            checkedIds.value.push(id);
        }
    } else {
        checkedIds.value = checkedIds.value.filter(_id => _id !== id);
    }
}
    
async function deleteFavorites() {
    if (checkedIds.value.length === 0) return;
    try {
        const response = await axios.delete(route('mypage.favorites.destroy'), { data: { project_ids: checkedIds.value } })
        showingProjects.value = showingProjects.value.filter(project => !response.data.deletedIds.includes(project.id));
        checkedIds.value = [];
    } catch (error) {
        router.get(route('mypage.favorites.'));
    }
}
</script>

<template>
    <Head title="お気に入り" />
    <AppLayout>
        <template #main>
            <div class="front-content sm:flex w-full p-10">
                <div class="mx-auto sm:w-2/3 h-full sm:pl-5">
                    <div class="flex justify-end mb-4 space-x-2">
                        <button @click="deleteFavorites" class="px-4 py-2 rounded" :class="{
                            'bg-blue-500 text-white': checkedIds.length !== 0,
                            'bg-gray-200': checkedIds.length === 0
                        }">
                            削除
                        </button>
                    </div>
                    <div v-if="showingProjects.length === 0" class="bg-white rounded-lg p-6 text-center">
                        <p class="text-gray-600">お気に入り案件がありません。</p>
                    </div>
                    <div v-else class="space-y-5 max-h-lvh overflow-y-auto">
                        <div v-for="project in showingProjects" :key="project.id">
                            <ProjectCard :project="project" :isMypage="true" @check="updateCheckedIds" />
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>
