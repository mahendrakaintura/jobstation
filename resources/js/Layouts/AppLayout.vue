<script setup>
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'

const isOpen = ref(false)

const logout = () => {
    router.post(route('logout'))
}

function isMypagePath(subPath="") {
    const path = window.location.pathname;
    const fullPath = subPath ? `/mypage/${subPath}` : "/mypage";
    return path === fullPath || path.startsWith(`${fullPath}/`);
}
</script>

<template>
    <header>
        <nav class="border-b border-gray-300 bg-blue-600 fixed top-0 w-full z-50">
            <div class="px-2 sm:px-6 lg:px-8">
                <div class="relative h-16">
                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        <button 
                            type="button"
                            @click="isOpen = !isOpen"
                            class="relative inline-flex items-center justify-center rounded-md p-2 hover:bg-gray-400"
                        >
                            <svg class="text-white h-6 w-6 fill-current" viewBox="0 0 24 24">
                                <path v-show="!isOpen" d="M24 6h-24v-4h24v4zm0 4h-24v4h24v-4zm0 8h-24v4h24v-4z"/>
                                <path v-show="isOpen" d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"/>
                            </svg>
                        </button>
                    </div>

                    <div class="hidden sm:ml-6 sm:block">
                        <div class="flex items-center justify-end space-x-4 h-16">
                            <Link href="/" class="mr-auto">
                                <img src="/img/logo.png" class="h-12" alt="ロゴ">
                            </Link>
                            <Link href="/" class="text-white font-bold">ホーム</Link>
                            <Link href="/about" class="text-white font-bold">ジョブステーションとは</Link>
                            <Link href="/service" class="text-white font-bold">サービスの流れ</Link>
                            
                            <template v-if="$page.props.auth.user">
                                <Link 
                                    href="/mypage/recommend" 
                                    class="rounded border border-gray-200 hover:bg-blue-400 text-white font-bold p-2"
                                >
                                    レコメンド
                                </Link>
                                <Link 
                                    href="/mypage/favorite" 
                                    class="rounded border border-gray-200 hover:bg-blue-400 text-white font-bold ml-3 p-2"
                                >
                                    マイページ
                                </Link>
                                <button
                                    @click="logout"
                                    class="rounded border border-gray-200 hover:bg-blue-400 text-white font-bold ml-3 p-2"
                                >
                                    ログアウト
                                </button>
                            </template>
                            <template v-else>
                                <Link 
                                    href="/register" 
                                    class="rounded border border-gray-200 hover:bg-blue-400 text-white font-bold p-2"
                                >
                                    会員登録
                                </Link>
                                <Link 
                                    href="/login" 
                                    class="rounded border border-gray-200 hover:bg-blue-400 text-white font-bold ml-3 p-2"
                                >
                                    ログイン
                                </Link>
                            </template>
                            <Link href="/" class="rounded border text-center text-sm text-white font-bold p-1">
                                企業様の<br>お問い合わせはこちら
                            </Link>
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

    <main class="bg-blue-50 mt-16">
        <nav v-if="isMypagePath()" class="flex gap-4 pt-5 text-center max-w-7xl mx-auto sm:px-6 lg:px-8">
            <Link 
                href="/mypage/favorites"
                :class="isMypagePath('favorites') ? 'bg-blue-500' : 'bg-gray-300'"
                class="rounded hover:bg-blue-500 font-bold p-2 grow"
            >
                お気に入り
            </Link>
            <Link 
                href="/mypage/entries"
                :class="isMypagePath('entries') ? 'bg-blue-500' : 'bg-gray-300'"
                class="rounded hover:bg-blue-500 font-bold p-2 grow"
            >
                応募履歴
            </Link>
            <Link 
                href="/mypage/skillsheet/edit"
                :class="isMypagePath('skillsheet/edit') ? 'bg-blue-500' : 'bg-gray-300'"
                class="rounded hover:bg-blue-500 font-bold p-2 grow"
            >
                スキルシート更新
            </Link>
            <Link 
                href="/mypage/password"
                :class="isMypagePath('password') ? 'bg-blue-500' : 'bg-gray-300'"
                class="rounded hover:bg-blue-500 font-bold p-2 grow"
            >
                パスワード変更
            </Link>
            <Link 
                href="/mypage/unregister"
                :class="isMypagePath('unregister') ? 'bg-blue-500' : 'bg-gray-300'"
                class="rounded hover:bg-blue-500 font-bold p-2 grow"
            >
                退会
            </Link>
        </nav>
        <slot name="main"></slot>
    </main>
    

    <footer>
        <div class="h-60 bg-gray-300">
            <p class="text-center p-5">フッター</p>
        </div>
        <div class="copyright fixed bottom-0 w-full font-bold text-center text-white bg-black p-1">
            <p>Copyright © 2024 ジョブステーション All rights Reserved.</p>
        </div>
    </footer>
</template>