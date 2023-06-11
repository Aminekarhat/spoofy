<template>
    <div>
        <div id="welcome">Welcome {{ user.name }} {{admin ? 'kek' : 'ke'}}</div>
        <div v-if="admin">
            <div class="stats">
                <div v-for="stat in stats" class="stat">
                    <div class="statName">{{ stat.name }}</div>
                    <div class="statCount">{{ stat.count }}</div>
                </div>
            </div>
        </div>
        <div v-else>
            <div class="jobOffer">
                <div v-for="offer in 5" class="offer">
                    <div class="offerName">Job Offer</div>
                    <div class="offerCount">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nam quisquam reiciendis optio tempora, modi esse dolores itaque nobis omnis ipsum?</div>
                    <div class="offerBtn">Apply</div>
                    <!-- <div class="offerName">{{ offer.title }}</div> -->
                    <!-- <div class="offerCount">{{ offer.text }}</div> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: JSON.parse(localStorage.getItem("user")),
            admin: false,
            stats: [
                {
                    name: "employees",
                    count: 9,
                },
                {
                    name: "request congé",
                    count: 5,
                },
                {
                    name: "requests recrutment",
                    count: 7,
                },
            ],
            jobOffers: [
                {
                    title: "",
                },
            ],
        };
    },
    created() {
        this.admin = window.localStorage.getItem("admin") == 'true';
    },
};
</script>

<style>
#welcome {
    font-size: 32px;
    text-transform: capitalize;
    margin-bottom: 30px;
}

.stats {
    display: flex;
}
.stat {
    padding: 1.2rem;
    margin: 8px;
    border-radius: 4px;
}
.statName {
    text-transform: capitalize;
    opacity: 0.8;
}
.statCount {
    font-size: 28px;
}


.offers {
    display: flex;
}
.offer {
    padding: 1.2rem;
    margin: 8px;
    border-radius: 4px;
    background: rgba(255, 0, 0, 0.308);
    color: white;
}
.offerName {
    text-transform: capitalize;
    opacity: 0.8;
}
.offerCount {
    font-size: 28px;
}
.offerBtn{
  padding: 0.8rem 1.2rem;
  border-radius: 4px;
  color: black;
  text-transform: capitalize;
  background: white;
  width: fit-content;
  margin-left: auto;
  font-weight: 500;
  margin-top: 4px;
}


</style>
