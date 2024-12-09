<script setup>
import { Head, usePage } from '@inertiajs/vue3'
import { ref, watch, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import EntryCard from '@/Components/Entry/EntryCard.vue';

const props = defineProps({
    entries: {
        type: Object,
        required: true
    }
})


</script>

<template>
    <Head title="応募履歴" />
    <AppLayout>
        <template #main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white p-6 shadow rounded-lg">
                        <h2 class="text-lg font-medium mb-6">応募履歴</h2>
                        <!-- // -->
                        <div v-for="entry in entries.data" :key="entry.id" class="flex flex-col">
                            <EntryCard :entry="entry" />
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>