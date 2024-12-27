<script setup>
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'
import MypageMenu from '@/Components/User/MypageMenu.vue';

const isOpen = ref(false)
const logout = () => {
    router.post(route('logout'))
}

function isCurrentPath(path) {
    const currentPath = window.location.pathname;
    if (path.startsWith('/mypage')) {
        return currentPath.startsWith('/mypage');
    }
    return currentPath === path;
}
</script>

<template>
    <div class="flex flex-col min-h-screen">
        <header>
            <nav class="border-b border-gray-300 bg-blue-600 fixed top-0 w-full z-50">
                <div class="px-2 sm:px-6 lg:px-8">
                    <div class="relative h-16 flex items-center justify-between">

                        <Link href="/" class="flex-shrink-0">
                        <img src="/img/logo.png" class="h-12" alt="ロゴ">
                        </Link>

                        <div class="hidden lg:flex items-center justify-end space-x-4">
                            <Link href="/about" class="text-white font-bold hover:text-gray-200">ジョブステーションとは</Link>
                            <Link href="/service" class="text-white font-bold hover:text-gray-200">サービスの流れ</Link>

                            <template v-if="$page.props.auth.user">
                                <Link href="/mypage/favorites"
                                    class="rounded border border-gray-200 hover:bg-blue-400 text-white font-bold p-2">
                                マイページ</Link>
                                <button @click="logout"
                                    class="rounded border border-gray-200 hover:bg-blue-400 text-white font-bold p-2">ログアウト</button>
                            </template>
                            <template v-else>
                                <Link href="/register"
                                    class="rounded border border-gray-200 hover:bg-blue-400 text-white font-bold p-2">
                                会員登録</Link>
                                <Link href="/login"
                                    class="rounded border border-gray-200 hover:bg-blue-400 text-white font-bold p-2">
                                ログイン</Link>
                            </template>

                            <Link href="/" class="rounded border text-center text-sm text-white font-bold p-1">
                            企業様の<br>お問い合わせはこちら</Link>
                        </div>

                        <div class="flex lg:hidden">
                            <button type="button" @click="isOpen = !isOpen"
                                class="inline-flex items-center justify-center rounded-md p-2 text-white hover:bg-blue-500 focus:outline-none">
                                <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g v-show="!isOpen">
                                        <rect y="4" width="24" height="2" rx="1" />
                                        <rect y="11" width="24" height="2" rx="1" />
                                        <rect y="18" width="24" height="2" rx="1" />
                                    </g>
                                    <g v-show="isOpen">
                                        <path d="M6.343 6.343l11.314 11.314" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" />
                                        <path d="M17.657 6.343L6.343 17.657" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" />
                                    </g>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div :class="isOpen ? 'block' : 'hidden'" class="md:hidden">
                <div class="overflow-hidden px-2 pb-5 pt-2">
                    <Link href="/" class="text-white font-bold w-56">ホーム</Link><br>
                    <Link href="/about" class="text-white font-bold w-56 mt-2">ジョブステーションとは</Link>
                    <Link href="/service" class="text-white font-bold w-56 mt-2">サービスの流れ</Link>
                </div>
            </div>
        </nav>
    </header>

        <main class="bg-blue-50 mt-16 flex-grow">
            <MypageMenu />
            <slot name="main"></slot>
        </main>


        <footer>
            <div class="copyright bottom-0 w-full font-bold text-center text-white bg-black p-1">
                <p>© 2025 JobStation</p>
            </div>
        </footer>
    </div>
</template>