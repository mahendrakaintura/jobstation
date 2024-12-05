<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Alert from '@/Components/Alert.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, computed } from 'vue';

const form = useForm({
    email: '',
    password: '',
    nationality: '',
    other_nationality: '',
});

const isOtherNationality = computed(() => form.nationality === 'その他');

const isFormValid = computed(() => {
    if (!form.email || !form.password || !form.nationality) return false;
    if (form.nationality === 'その他' && !form.other_nationality) return false;
    return true;
});

const showAlert = ref(false);
const alertMessage = ref('');
const alertType = ref('success');

const submit = () => {
    form.post(route('register'), {
        onSuccess: () => {
            alert('会員登録ありがとうございます。確認メールを送信しましたので、メール内のリンクをクリックして登録を完了してください。');
        },
        onError: () => {
            alert('登録処理中にエラーが発生しました。もう一度お試しください。');
        }
    });
};

</script>

<template>

    <Head title="会員登録" />
    <AppLayout>
        <template #main>
            <GuestLayout class="mx-auto sm:w-[500px] py-28 px-5">
                <form @submit.prevent="submit">
                    <div class="mt-4">
                        <InputLabel for="email" value="メールアドレス" />
                        <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                            autocomplete="username" />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="password" value="パスワード" />
                        <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password"
                            required autocomplete="new-password" />
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="mt-4">
                        <InputLabel value="国籍" />
                        <div class="mt-2 space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" v-model="form.nationality" value="日本" class="form-radio" />
                                <span class="ml-2">日本</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" v-model="form.nationality" value="その他" class="form-radio" />
                                <span class="ml-2">その他</span>
                            </label>
                        </div>
                        <div v-if="isOtherNationality" class="mt-2">
                            <TextInput v-model="form.other_nationality" class="mt-1 block w-full"
                                placeholder="国籍を入力してください" type="text" required />
                        </div>
                        <InputError class="mt-2" :message="form.errors.nationality" />
                        <InputError class="mt-2" :message="form.errors.other_nationality" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <Link :href="route('login')"
                            class="underline text-sm text-sky-600 hover:text-sky-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        すでに登録済みの方はこちら？
                        </Link>

                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing || !isFormValid }"
                            :disabled="form.processing || !isFormValid">
                            登録する
                        </PrimaryButton>
                    </div>
                </form>
            </GuestLayout>
            <Alert :message="alertMessage" :type="alertType" v-if="showAlert" @close="showAlert = false" />
        </template>
    </AppLayout>
</template>