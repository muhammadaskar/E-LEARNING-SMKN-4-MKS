<template>
  <div>
    <PageComponent title="Dashboard">
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">
        <div
          class="
            flex flex-col
            py-4
            px-6
            rounded-md
            shadow-md
            bg-teal-100
            h-[120px]
          "
        >
          <div class="flex justify-between">
            <div>
              <div v-if="loading" class="mt-2">
                <div class="animate-pulse flex">
                  <div class="flex-1 space-y-4 py-1">
                    <div class="h-2 bg-slate-700 rounded"></div>
                  </div>
                </div>
              </div>
              <h1 v-else class="mt-1 text-2xl font-bold">{{ guru }}</h1>
              <h4 class="mt-1 text-lg font-bold">Guru</h4>
            </div>
            <div class="">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-16 w-16 mt-2 inline-block"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                />
              </svg>
            </div>
          </div>
        </div>
        <div
          class="
            flex flex-col
            py-4
            px-6
            rounded-md
            shadow-md
            bg-blue-100
            h-[120px]
          "
        >
          <div class="flex justify-between">
            <div>
              <div v-if="loading" class="mt-2">
                <div class="animate-pulse flex">
                  <div class="flex-1 space-y-4 py-1">
                    <div class="h-2 bg-slate-700 rounded"></div>
                  </div>
                </div>
              </div>
              <h1 v-else class="mt-1 text-2xl font-bold">{{ siswa }}</h1>
              <h4 class="mt-1 text-lg font-bold">Siswa</h4>
            </div>
            <div class="">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-16 w-16 mt-2 inline-block"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                />
              </svg>
            </div>
          </div>
        </div>
        <div
          class="
            flex flex-col
            py-4
            px-6
            rounded-md
            shadow-md
            bg-green-100
            h-[120px]
          "
        >
          <div class="flex justify-between">
            <div>
              <div v-if="loading" class="mt-2">
                <div class="animate-pulse flex">
                  <div class="flex-1 space-y-4 py-1">
                    <div class="h-2 bg-slate-700 rounded"></div>
                  </div>
                </div>
              </div>
              <h1 v-else class="mt-1 text-2xl font-bold">{{ orang_tua }}</h1>
              <h4 class="mt-1 text-lg font-bold">Orang Tua Siswa</h4>
            </div>
            <div class="">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-16 w-16 mt-2 inline-block"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"
                />
              </svg>
            </div>
          </div>
        </div>
      </div>
    </PageComponent>
  </div>
</template>

<script setup>
import PageComponent from "../../components/PageComponent.vue";

import { computed, ref, watch } from "vue";
import store from "../../store";

const loading = computed(() => store.state.admins.loading);

const guru = computed(() => store.state.admins.guru);
const siswa = computed(() => store.state.admins.siswa);
const orang_tua = computed(() => store.state.admins.orang_tua);

store.dispatch("getAdminDashboard");
</script>

<style>
</style>