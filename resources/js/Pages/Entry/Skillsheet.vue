<script setup>
import { ref } from 'vue'
import { Head, useForm } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import SelectInput from '@/Components/SelectInput.vue'

const props = defineProps({
    constants: {
        type: Object,
        required: true,
        default: () => ({
            basic_info: {},
            self_analysis: {
                items: {},
                ratings: []
            },
            desired_price: {},
            desired_start: {},
            desired_remote: {},
            desired_area: {},
            desired_work: {},
            age: [],
            years_of_experience: []
        })
    },
    user: {
        type: Object,
        required: true
    },
    temporaryData: {
        type: Object,
        default: null
    }
});

const selfAnalysisItems = props.constants?.self_analysis?.items || {};
const selfAnalysisRatings = props.constants?.self_analysis?.ratings || [];
const experienceForm = {
    project_title: '',
    period: '',
    description: '',
    framework: '',
    frontend: '',
    backend: '',
    server: '',
    database: '',
    tool: '',
    middleware: '',
    os: '',
    others: ''
};

const form = useForm({
    basicInfo: {
        name: props.user?.name ?? '',
        initial: props.user?.initial ?? '',
        age: props.user?.age ?? 18,
        sex: props.user?.sex ?? 'man',
        nationality: props.user?.nationality ?? '日本',
        years_of_experience: props.user?.years_of_experience ?? 0,
        address: props.user?.address ?? '',
        education: props.user?.education ?? '',
        pr: props.user?.pr ?? '',
        train_line: props.user?.train_line ?? '',
        station: props.user?.station ?? '',
        desired_area: props.user?.desired_area ?? 1,
        desired_start: props.user?.desired_start ?? 1,
        desired_price: props.user?.desired_price ?? 1,
        desired_remote: props.user?.desired_remote ?? 1,
        desired_work: {
            work1: props.user?.desired_work?.work1 ?? '',
            work2: props.user?.desired_work?.work2 ?? '',
            work3: props.user?.desired_work?.work3 ?? '',
            work4: props.user?.desired_work?.work4 ?? '',
            work5: props.user?.desired_work?.work5 ?? ''
        },
        desired_language: props.user?.desired_language ?? '',
        desired_place: props.user?.desired_place ?? '',
        desired_others: props.user?.desired_others ?? '',
        self_analysis: props.user?.self_analysis ?? Object.fromEntries(
            Object.keys(selfAnalysisItems).map(key => [key, 1])
        ),
    },
    experiences: props.user?.workExperiences ?? [{ ...experienceForm }]
});

const addExperience = () => {
    if (form.experiences.length >= 5) return;
    form.experiences.push({ ...experienceForm });
};

const removeExperience = (index) => {
    if (form.experiences.length > 1) {
        form.experiences.splice(index, 1);
    }
};

const formErrors = ref({});
const submit = () => {
    form.post(route('entry.submit'), {
        onSuccess: () => {
            router.visit(route('mypage.entries.index'))
        },
        onError: (errors) => {
            formErrors.value = errors;
            let errorMessage = '以下のエラーが発生しました：\n';
            if (errors.basicInfo) {
                Object.entries(errors.basicInfo).forEach(([field, message]) => {
                    errorMessage += `- ${getFieldLabel(field)}: ${message}\n`;
                });
            }
            alert(errorMessage);
        }
    })
};

const temporarySave = () => {
    axios.post(route('entry.temporary-save'), {
        skillsheet: {
            basicInfo: form.basicInfo,
            experiences: form.experiences
        }
    })
        .then(response => {
            if (response.data.success) {
                window.alert('入力内容を一時保存しました。')
                window.location.href = route('home')
            }
        })
        .catch(error => {
            console.error('一時保存時にエラーが発生しました:', error)
        })
}
</script>

<template>
    <AppLayout>
        <template #main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <form @submit.prevent="submit" class="bg-white p-6 shadow rounded-lg">
                        <div class="flex justify-end gap-4 mt-6">
                            <button type="button" @click="temporarySave"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                                保存
                            </button>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                登録
                            </button>
                        </div>
                        <h2 class="text-lg font-medium mb-6">基本情報</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <InputLabel value="名前*" />
                                <TextInput v-model="form.basicInfo.name" type="text" class="mt-1 block w-full"
                                    required />
                            </div>
                            <div>
                                <InputLabel value="イニシャル*" />
                                <TextInput v-model="form.basicInfo.initial" type="text" class="mt-1 block w-full"
                                    required />
                            </div>
                            <div>
                                <InputLabel value="年齢*" />
                                <SelectInput v-model="form.basicInfo.age" class="mt-1 block w-full" required>
                                    <option v-for="age in constants?.age" :key="age" :value="age">{{ age }}歳</option>
                                </SelectInput>
                            </div>
                            <div>
                                <InputLabel value="性別*" />
                                <div class="mt-1 space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" v-model="form.basicInfo.sex" value="man" class="mr-2">
                                        男性
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" v-model="form.basicInfo.sex" value="woman" class="mr-2">
                                        女性
                                    </label>
                                </div>
                            </div>
                            <div>
                                <InputLabel value="実務経験年数*" />
                                <SelectInput v-model="form.basicInfo.years_of_experience" class="mt-1 block w-full"
                                    required>
                                    <option v-for="year in constants?.years_of_experience" :key="year" :value="year">
                                        {{ year }}年
                                    </option>
                                </SelectInput>
                            </div>
                            <div>
                                <InputLabel value="住所*" />
                                <TextInput v-model="form.basicInfo.address" type="text" class="mt-1 block w-full"
                                    required />
                            </div>
                            <div>
                                <InputLabel value="最終学歴" />
                                <TextInput v-model="form.basicInfo.education" type="text" class="mt-1 block w-full" />
                            </div>
                            <div class="col-span-2">
                                <InputLabel value="資格・PR・その他" />
                                <textarea v-model="form.basicInfo.pr"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    rows="3">
                                </textarea>
                            </div>
                            <div>
                                <InputLabel value="路線*" />
                                <TextInput v-model="form.basicInfo.train_line" type="text" class="mt-1 block w-full"
                                    required />
                            </div>
                            <div>
                                <InputLabel value="最寄駅*" />
                                <TextInput v-model="form.basicInfo.station" type="text" class="mt-1 block w-full"
                                    required />
                            </div>
                            <div>
                                <InputLabel value="月単価*" />
                                <SelectInput v-model="form.basicInfo.desired_price" class="mt-1 block w-full" required>
                                    <option v-for="(price, key) in constants?.desired_price" :key="key" :value="key">
                                        {{ price }}
                                    </option>
                                </SelectInput>
                            </div>
                            <div>
                                <InputLabel value="稼働時期*" />
                                <SelectInput v-model="form.basicInfo.desired_start" class="mt-1 block w-full" required>
                                    <option v-for="(month, key) in constants?.desired_start" :key="key" :value="key">
                                        {{ month }}
                                    </option>
                                </SelectInput>
                            </div>
                            <div>
                                <InputLabel value="リモート勤務のご希望*" />
                                <SelectInput v-model="form.basicInfo.desired_remote" class="mt-1 block w-full" required>
                                    <option v-for="(remote, key) in constants?.desired_remote" :key="key" :value="key">
                                        {{ remote }}
                                    </option>
                                </SelectInput>
                            </div>
                            <div>
                                <InputLabel value="エリア*" />
                                <SelectInput v-model="form.basicInfo.desired_area" class="mt-1 block w-full" required>
                                    <option v-for="(area, key) in constants?.desired_area" :key="key" :value="key">
                                        {{ area }}
                                    </option>
                                </SelectInput>
                            </div>
                            <div>
                                <InputLabel value="業務範囲" />
                                <div class="space-y-2">
                                    <SelectInput v-model="form.basicInfo.desired_work.work1" class="mt-1 block w-full">
                                        <option value="">選択してください</option>
                                        <option v-for="(work, key) in constants?.desired_work" :key="key" :value="key">
                                            {{ work }}
                                        </option>
                                    </SelectInput>
                                    <SelectInput v-model="form.basicInfo.desired_work.work2" class="block w-full">
                                        <option value="">選択してください</option>
                                        <option v-for="(work, key) in constants?.desired_work" :key="key" :value="key">
                                            {{ work }}
                                        </option>
                                    </SelectInput>
                                    <SelectInput v-model="form.basicInfo.desired_work.work3" class="block w-full">
                                        <option value="">選択してください</option>
                                        <option v-for="(work, key) in constants?.desired_work" :key="key" :value="key">
                                            {{ work }}
                                        </option>
                                    </SelectInput>
                                    <SelectInput v-model="form.basicInfo.desired_work.work4" class="block w-full">
                                        <option value="">選択してください</option>
                                        <option v-for="(work, key) in constants?.desired_work" :key="key" :value="key">
                                            {{ work }}
                                        </option>
                                    </SelectInput>
                                    <SelectInput v-model="form.basicInfo.desired_work.work5" class="block w-full">
                                        <option value="">選択してください</option>
                                        <option v-for="(work, key) in constants?.desired_work" :key="key" :value="key">
                                            {{ work }}
                                        </option>
                                    </SelectInput>
                                </div>
                            </div>
                            <div>
                                <InputLabel value="言語" />
                                <textarea v-model="form.basicInfo.desired_language"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    rows="8" placeholder="html, css, javascript">
                                    </textarea>
                            </div>
                            <div class="col-span-2">
                                <InputLabel value="場所" />
                                <textarea v-model="form.basicInfo.desired_place"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    rows="3">
                                </textarea>
                            </div>
                            <div class="col-span-2">
                                <InputLabel value="その他" />
                                <textarea v-model="form.basicInfo.desired_others"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    rows="3">
                                </textarea>
                            </div>
                        </div>
                        <div class="mt-8">
                            <h2 class="text-lg font-medium mb-6">自己分析</h2>
                            <div class="grid grid-cols-4 gap-4">
                                <template v-for="(label, key) in selfAnalysisItems" :key="key">
                                    <div class="flex items-center gap-4 mb-2">
                                        <span class="min-w-[120px]">{{ label }}</span>
                                        <SelectInput v-model="form.basicInfo.self_analysis[key]" class="w-24">
                                            <option v-for="n in selfAnalysisRatings" :key="n" :value="n">{{ n }}
                                            </option>
                                        </SelectInput>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="mt-8">
                            <h2 class="text-lg font-medium mb-6">業務経歴</h2>
                            <div v-for="(experience, index) in form.experiences" :key="index"
                                class="mb-8 p-6 border rounded-lg">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-md font-medium">経歴 {{ index + 1 }}</h3>
                                    <button type="button" @click="removeExperience(index)"
                                        class="text-red-600 hover:text-red-800" v-if="form.experiences.length > 1">
                                        削除
                                    </button>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <InputLabel value="プロジェクト名*" />
                                        <TextInput v-model="experience.project_title" type="text"
                                            class="mt-1 block w-full" required />
                                    </div>
                                    <div>
                                        <InputLabel value="期間*" />
                                        <TextInput v-model="experience.period" type="text" class="mt-1 block w-full"
                                            required />
                                    </div>
                                    <div class="col-span-2">
                                        <InputLabel value="プロジェクト概要*" />
                                        <textarea v-model="experience.description"
                                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="grid grid-cols-3 gap-4 mt-4">
                                    <div>
                                        <InputLabel value="フレームワーク" />
                                        <TextInput v-model="experience.framework" type="text"
                                            class="mt-1 block w-full" />
                                    </div>
                                    <div>
                                        <InputLabel value="フロントエンド" />
                                        <TextInput v-model="experience.frontend" type="text"
                                            class="mt-1 block w-full" />
                                    </div>
                                    <div>
                                        <InputLabel value="バックエンド" />
                                        <TextInput v-model="experience.backend" type="text" class="mt-1 block w-full" />
                                    </div>
                                    <div>
                                        <InputLabel value="サーバー" />
                                        <TextInput v-model="experience.server" type="text" class="mt-1 block w-full" />
                                    </div>
                                    <div>
                                        <InputLabel value="データベース" />
                                        <TextInput v-model="experience.database" type="text"
                                            class="mt-1 block w-full" />
                                    </div>
                                    <div>
                                        <InputLabel value="ツール" />
                                        <TextInput v-model="experience.tool" type="text" class="mt-1 block w-full" />
                                    </div>
                                    <div>
                                        <InputLabel value="ミドルウェア" />
                                        <TextInput v-model="experience.middleware" type="text"
                                            class="mt-1 block w-full" />
                                    </div>
                                    <div>
                                        <InputLabel value="OS" />
                                        <TextInput v-model="experience.os" type="text" class="mt-1 block w-full" />
                                    </div>
                                    <div>
                                        <InputLabel value="その他" />
                                        <TextInput v-model="experience.others" type="text" class="mt-1 block w-full" />
                                    </div>
                                </div>
                            </div>
                            <button type="button" @click="addExperience"
                                class="mt-4 text-indigo-600 hover:text-indigo-800" v-if="form.experiences.length < 5">
                                ＋ 経歴を追加
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    </AppLayout>
</template>