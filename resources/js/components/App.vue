<template>
    <div v-if="show">
        <Login v-if="mode == 0" />
        <div v-if="mode == 1" id="wrapper">
            <NavBar />
            <div id="container">
                <div id="sidebar">
                    <div
                        v-for="page in (admin ? pages : userPages)"
                        @click="currentPage = page"
                        class="sidebarBtn"
                    >
                        {{ page }}
                    </div>
                </div>
                <div id="content">
                    <Home v-if="currentPage == 'home'" />
                    <Conge v-if="currentPage == 'congé'" />
                    <Employees v-if="currentPage == 'employees'" />
                    <Demande v-if="currentPage == 'demande'" />
                    <Recrutement v-if="currentPage == 'recrutement'" />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Home from "./Home.vue";
import Conge from "./Conge.vue";
import Employees from "./Employees.vue";
import Demande from "./Demande.vue";
import NavBar from "./NavBar.vue";
import Login from "./Login.vue";
import Recrutement from "./Recrutement.vue";
export default {
    components: { Home, Recrutement, Conge, Employees, NavBar, Login, Demande },
    props: ["mode"],
    created() {
        if (!localStorage.getItem("user") && this.mode != 0) {
            window.location.href = "/login";
        } else {
            this.show = true;
        }
    },
    data() {
        return {
            currentPage: "home",
            show: false,
            pages: ["home", "employees", "congé", 'recrutement'],
            userPages: ["home", "demande", "congé"],
            user: JSON.parse(localStorage.getItem('user')),
            admin: localStorage.getItem('admin') == "false" ? false : true
        };
    },
};
</script>
