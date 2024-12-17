<script setup>
import { Head, useForm, router } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

const form = useForm({
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('mypage.password.store'), {
        onSuccess: () => {
            form.reset();
            window.alert('パスワードを変更しました。')
        },
        onError: (errors) => {
            console.error(errors);
            window.alert(`${errors.message}\n${errors.system}`)
        }
    });
};
</script>

<template>
    <Head title="パスワード変更" />
    <AppLayout>
        <template #main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <form @submit.prevent="submit" class="bg-white p-6 shadow rounded-lg flex flex-col">
                        <h2>パスワード変更</h2>
                        <div class="flex justify-center mb-4 gap-4 items-center">
                            <InputLabel for="password" value="新しいパスワード" />
                            <span class="text-red-500">必須</span>
                            <TextInput
                                id="password"
                                type="password"
                                class="self-center"
                                v-model="form.password"
                                required
                                autocomplete="new-password"
                            />
                            <InputError :message="form.errors.password" class="mt-2" />
                        </div>
                        <div class="flex justify-center mb-4s gap-4 items-center">
                            <InputLabel for="password_confirmation" value="新しいパスワード（確認用）" />
                            <span class="text-red-500">必須</span>
                            <TextInput
                                id="password_confirmation"
                                type="password"
                                class="self-center"
                                v-model="form.password_confirmation"
                                required
                                autocomplete="new-password"
                            />
                            <InputError :message="form.errors.password_confirmation" class="mt-2" />
                        </div>
                        <div class="flex items-center justify-center mt-4">
                            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                変更する
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </template>
    </AppLayout>
</template>