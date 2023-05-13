<template>

    <div id="nav" :class="!admin ? 'r' : 'p' ">
        <div class="logo">Welcome {{user.name}}</div>
    </div>

</template>


<script>
export default {
    data() {
        return{
            user: JSON.parse(localStorage.getItem('user')),
            admin: localStorage.getItem('admin') == "false" ? false : true
        }
    }
}
</script>

<style>

</style>