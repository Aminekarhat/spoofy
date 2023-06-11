<template>
    <div v-if="!admin">
        <div class="dateSelect">
            <div>Select Date:</div>
            <div>
                <input v-model="date" type="date" />
            </div>
        </div>
        <div class="errors">
            <div v-for="error in errors">
                <div v-for="err in error" class="error">{{ err }}</div>
            </div>
        </div>
        <div class="flexx">
            <div @click="submit()" class="loginButton submitBtn">submit</div>
        </div>
    </div>
    <div v-else>
        <div class="rqsts">
            <div v-for="i in rqsts" class="rqst">
                <div>
                    <div class="rqstName">{{ i.username }}</div>
                    <div class="rqstDate">{{ i.date }} days ago</div>
                </div>
                <div class="rqstBtns">
                    <div class="btnAccept">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g
                                id="SVGRepo_tracerCarrier"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            ></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M21.5821 5.54289C21.9726 5.93342 21.9726 6.56658 21.5821 6.95711L10.2526 18.2867C9.86452 18.6747 9.23627 18.6775 8.84475 18.293L2.29929 11.8644C1.90527 11.4774 1.89956 10.8443 2.28655 10.4503C2.67354 10.0562 3.30668 10.0505 3.70071 10.4375L9.53911 16.1717L20.1679 5.54289C20.5584 5.15237 21.1916 5.15237 21.5821 5.54289Z"
                                    fill="#26a269"
                                ></path>
                            </g>
                        </svg>
                    </div>
                    <div class="btnRefuse"><span>X</span></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            admin: localStorage.getItem("admin") == "false" ? false : true,
            user: JSON.parse(localStorage.getItem("user")),
            date: "",
            errors: [],
            rqsts: [
                {
                    username: "Jhon Doe",
                    date: 3,
                },
                {
                    username: "Diego Kreiger",
                    date: 6,
                },
                {
                    username: "Waldo Welch",
                    date: 9,
                },
                {
                    username: "Prince Jones",
                    date: 2,
                },
                {
                    username: "Sam Hyde",
                    date: 1,
                },
            ],
        };
    },
    methods: {
        submit() {
            axios
                .post("/user/off", { user: this.user, date: this.date })
                .then((res) => {
                    this.date = "";
                    this.errors = { x: ["sent."] };
                })
                .catch((err) => {
                    this.errors = err.response.data.errors;
                });
        },
    },
};
</script>

<style>
.checkmark {
    border-radius: 50%;
    display: block;
    stroke-width: 2;
    stroke: green;
    stroke-miterlimit: 10;
    stroke-dashoffset: 0;
}
.btnRefuse span {
    font-size: 28px;
    color: red;
}
.btnRefuse,
.btnAccept {
    height: 35px;
    width: 35px;
    border-radius: 4px;
    background: white;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 4px;
    padding: 4px;
}
.rqst {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px;
    border: 1px solid #129FF8;
    border-radius: 4px;
    margin: 12px 0;
}
.rqstName {
    font-size: 19px;
}
.rqstDate {
    opacity: 0.8;
}
.rqstBtns {
    display: flex;
    align-items: center;
}
.dateSelect {
    text-align: center;
    margin-bottom: 12px ;
}
</style>
