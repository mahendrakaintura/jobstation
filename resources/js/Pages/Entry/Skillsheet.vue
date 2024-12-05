<script setup>
import { ref } from 'vue'
import { Head, useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import SelectInput from '@/Components/SelectInput.vue'

const props = defineProps({
    constants: {
        type: Object,
        required: true
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

const defaultValues = {
    name: '',
    initial: '',
    age: 18,
    sex: 'man',
    nationality: '日本',
    years_of_experience: 0,
    address: '',
    education: '',
    train_line: '',
    station: '',
    desired_price: 1,
    desired_start: 1,
    desired_remote: 1,
    desired_work: [],
    desired_language: [],
    desired_area: 1
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
        train_line: props.user?.train_line ?? '',
        station: props.user?.station ?? '',
        desired_price: props.user?.desired_price ?? 1,
        desired_start: props.user?.desired_start ?? 1,
        desired_remote: props.user?.desired_remote ?? 1,
        desired_work: props.user?.desired_work ?? [],
        desired_language: props.user?.desired_language ?? [],
        desired_area: props.user?.desired_area ?? 1
    },
    experiences: props.user?.workExperiences ?? [{
        project_title: '',
        period: '',
        description: ''
    }]
});

const addExperience = () => {
    if (form.experiences.length >= 5) return;
    form.experiences.push({
        project_title: '',
        period: '',
        description: ''
    });
};

const removeExperience = (index) => {
    if (form.experiences.length > 1) {
        form.experiences.splice(index, 1);
    }
};

const submit = () => {
    form.post(route('skillsheet.store'), {
        onSuccess: () => {
            router.visit(route('mypage.entries'));
        }
    });
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
                window.alert('入力内容を一時保存しました。');
                window.location.href = route('home');
            }
        });
};
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
                        <SelectInput v-model="form.basicInfo.sex" class="mt-1 block w-full" required>
                            <option value="man">男性</option>
                            <option value="woman">女性</option>
                        </SelectInput>
                    </div>
                    <div>
                        <InputLabel value="実務経験年数*" />
                        <SelectInput v-model="form.basicInfo.years_of_experience" class="mt-1 block w-full" required>
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
                        <TextInput v-model="form.basicInfo.education" type="text" class="mt-1 block w-full"
                            />
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
                    <div class="col-span-2">
                        <InputLabel value="業務範囲" />
                        <div class="grid grid-cols-3 gap-2 mt-1">
                            <label v-for="(work, key) in constants?.desired_work || {}" :key="key"
                                class="flex items-center">
                                <input type="checkbox" v-model="form.basicInfo.desired_work" :value="key"
                                    class="mr-2">
                                {{ work }}
                            </label>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <InputLabel value="言語" />
                        <div class="grid grid-cols-3 gap-2 mt-1">
                            <label v-for="(lang, key) in constants?.desired_language || {}" :key="key"
                                class="flex items-center">
                                <input type="checkbox" v-model="form.basicInfo.desired_language" :value="key"
                                    class="mr-2">
                                {{ lang }}
                            </label>
                        </div>
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