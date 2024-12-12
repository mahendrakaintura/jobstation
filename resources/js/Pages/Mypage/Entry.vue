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

onMounted(() => {
    const page = usePage();
    const flash = page.props.flash;
    
    if (flash?.message && !window.__alertShown) {
        window.__alertShown = true;
        window.alert(flash.message);
        
        router.reload({ preserveScroll: true });
    }
});
</script>

<template>
    <Head title="応募履歴" />
    <AppLayout>
        <template #main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white p-6 shadow rounded-lg">
                        <!-- // -->
                        <div class="border-t flex flex-col items-stretch">
                            <EntryCard v-for="entry in entries" :key="entry.id" :entry="entry" />
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>