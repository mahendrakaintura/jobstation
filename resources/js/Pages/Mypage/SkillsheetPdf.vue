<script setup>
import { onMounted, ref } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps({
    pdfData: {
        type: String,
        required: true
    }
});

const url = ref({});
const link = document.createElement('a');

const generateBlobUrl = () => {
    const byteCharacters = atob(props.pdfData);
    const byteNumbers = new Uint8Array([...byteCharacters].map(c => c.charCodeAt(0)));
    const blob = new Blob([byteNumbers], { type: 'application/pdf' });
    url.value = URL.createObjectURL(blob);
}

onMounted(() => {
    generateBlobUrl();

});

const download = () => {
    if (!url.value) {
        generateBlobUrl();
    }
    link.href = url.value;
    link.download = 'スキルシート.pdf';
    link.click(); 
}
</script>

<template>
    <AppLayout>
        <template #main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="flex justify-end gap-4 m-6">
                        <button type="button" @click="download"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            ダウンロード
                        </button>
                    </div>
                    <iframe
                        v-if="url"
                        :src="url"
                        width="100%"
                        height="600px"
                        style="border: none;"
                    ></iframe>
                </div>
            </div>
        </template>
    </AppLayout>
</template>