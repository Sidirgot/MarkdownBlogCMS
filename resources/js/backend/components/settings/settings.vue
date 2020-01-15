<template>
    <div class="container mx-auto flex my-4">
        <aside class="px-4 py-3 w-48">
            <ul>
                <li class="border-b border-navbar text-white text-sm px-2 py-2"><router-link :to="{name: 'social-media'}">Social Media</router-link></li>
                <li class="border-b border-navbar text-white text-sm px-2 py-2"><router-link :to="{name: 'admin-account'}">Account</router-link></li>
            </ul>
        </aside>

        <main class="mx-6 w-full">
        </main>
    </div>
</template>

<script>
export default {
}
</script>