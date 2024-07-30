<script setup>
import NavLink from "./NavLink.vue";

defineProps({
    can:Object
});
</script>

<template>
    <nav>
        <ul class="flex space-x-6">
            <li>
                <NavLink href="/" :active="$page.component === 'Home'">Home</NavLink>
            </li>
            <li>
                <NavLink  href="/users/create" :active="$page.component === 'Users/Create'">Create</NavLink>
            </li>
            <li>
                <NavLink href="/users" :active="$page.component === 'Users/Index'">Users</NavLink>
            </li>
            <li>
                <NavLink href="/settings" :active="$page.component === 'Settings'">Settings</NavLink>
            </li>
            <li>
                <NavLink href="/logout" method="post" as="button">
                    Log Out
                </NavLink>
            </li>
<!--            <li>-->
<!--                <Link class="text-blue-500 hover:underline" href="/logout" method="post" as="button" :data="{foo:'bar'}">Logout</Link>-->
<!--            </li>-->
        </ul>
    </nav>

</template>
