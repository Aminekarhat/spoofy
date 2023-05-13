<template>
    <div id="authWrapper">
        <div id="login">
            <div class="title">{{ form }}</div>
            <div class="subtitle">Lorem ipsum dolor sit.</div>

            <div v-if="form == 'login'" class="form">
                <div class="formG">
                    <div class="formT">Email</div>
                    <input v-model="email" type="text" class="formI" />
                </div>
                <div class="formG">
                    <div class="formT">Password</div>
                    <input v-model="password" type="password" class="formI" />
                </div>
            </div>

            <div v-if="form == 'register'" class="form">
                <div class="formG">
                    <div class="formT">Name</div>
                    <input v-model="name" type="text" class="formI" />
                </div>
                <div class="formG">
                    <div class="formT">Email</div>
                    <input v-model="email" type="text" class="formI" />
                </div>
                <div class="formG">
                    <div class="formT">Password</div>
                    <input v-model="password" type="password" class="formI" />
                </div>
                <div class="formG">
                    <div class="formT">Confirm Password</div>
                    <input
                        v-model="confirmPassword"
                        type="password"
                        class="formI"
                    />
                </div>
            </div>

            <div class="errors">
                <div v-for="error in errors">
                    <div v-for="err in error" class="error">{{ err }}</div>
                </div>
            </div>
            <div
                @click="form == 'login' ? login() : register()"
                class="loginButton"
            >
                {{ form }}
            </div>
            <div v-if="form == 'login'" class="register">
                <div>Don't have an account yet? <span @click="goTo('register')">Register</span></div>
            </div>
            <div v-if="form == 'register'" class="register">
                <div>Already have an account? <span @click="goTo('login')">Login</span></div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    created() {
        console.log(document.URL);
    },
    data() {
        return {
            email: "kek@kek.com",
            password: "kekkekkek",
            confirmPassword: "kekkekkek",
            name: "kekster",
            errors: {},
            form: document.URL.replace(/^.*[\\\/]/, ''),
        };
    },
    computed: {},
    methods: {
        login() {
            this.errors = {};
            axios
                .post("/login", { email: this.email, password: this.password })
                .then((res) => {
                    if (res.data.gucci == true) {
                        localStorage.setItem(
                            "user",
                            JSON.stringify(res.data.user)
                        );
                        localStorage.setItem('admin', res.data.admin ? true : false)
                        window.location.href = '/home'
                    } else {
                        this.errors = { x: ["Invalid Credentials."] };
                    }
                })
                .catch((err) => {
                    this.errors = err.response.data.errors;
                });
        },
        register() {
            this.errors = {};
            axios
                .post("/register", {
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.confirmPassword,
                    name: this.name,
                })
                .then((res) => {
                    if (res.data.gucci == true) {
                        localStorage.setItem(
                            "user",
                            JSON.stringify(res.data.user)
                        );
                        window.location.href = '/home'
                    } else {
                        this.errors = { x: ["Error"] };
                    }
                })
                .catch((err) => {
                    this.errors = err.response.data.errors;
                });
        },
        goTo(x) {
          window.location.href = x
        }
    },
};
</script>

<style></style>
