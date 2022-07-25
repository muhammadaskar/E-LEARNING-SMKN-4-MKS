<template>
  <div>
    <PageComponent>
      <template v-slot:header>
        <div class="flex justify-between items-center">
          <h1 class="text-3x1 font-bold text-gray-900">Diskusi</h1>
        </div>
      </template>
      <div v-if="discusses.loading" class="justify-center">
        <div
          class="
            border border-white-300
            shadow
            rounded-md
            p-6
            w-full
            mx-auto
            mb-2
          "
          v-for="n in 3"
          :key="n"
        >
          <div class="animate-pulse flex space-x-4">
            <div class="flex-1 space-y-6 py-1">
              <div class="h-2 bg-slate-700 rounded"></div>
              <div class="h-2 bg-slate-700 rounded"></div>
            </div>
          </div>
        </div>
      </div>

      <!-- List Discuss -->
      <div
        v-else
        class="relative overflow-x-auto shadow-md sm:rounded-lg p-4"
        v-for="discuss in discusses.data"
        :key="discuss.id"
      >
        <div class="flex flex-row">
          <div class="">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-12 w-12 mt-2 inline-block"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"
              />
            </svg>
          </div>
          <div class="basis-5/6 pl-4">
            <h1>{{ discuss.topic }}</h1>
            <div class="">{{ discuss.created_at }}</div>
          </div>
          <div class="pt-3">
            <router-link
              :to="{
                name: 'StudentDetailDiscuss',
                params: { id: discuss.id },
              }"
              class="
                inline-flex
                justify-center
                px-4
                border border-transparent
                shadow-sm
                text-sm
                font-medium
                rounded-md
                text-white
                bg-cyan-600
                hover:bg-cyan-700
                focus:outline-none
                focus:ring-2
                focus:ring-offset-2
                focus:ring-cyan-500
              "
              >join</router-link
            >
          </div>
        </div>
      </div>
      <!-- End List Discuss -->
    </PageComponent>
  </div>
</template>

<script setup>
import PageComponent from "../../../components/PageComponent.vue";
import store from "../../../store";
import { computed } from "vue";
import { useRoute, useRouter } from "vue-router";
import Swal from "sweetalert2";
const router = useRouter();

const route = useRoute();

const discusses = computed(() => store.state.discusses);
store.dispatch("getStudentDiscusses");
</script>

<style>
</style>