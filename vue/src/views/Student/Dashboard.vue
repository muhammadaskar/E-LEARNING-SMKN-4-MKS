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
              <h1 v-else class="mt-1 text-2xl font-bold">{{ tugas }}</h1>
              <h4 class="mt-1 text-lg font-bold">Jumlah Tugas</h4>
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
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
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
              <h1 v-else class="mt-1 text-2xl font-bold">
                {{ tugas_selesai }}
              </h1>
              <h4 class="mt-1 text-lg font-bold">Dikumpulkan</h4>
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
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
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
              <h1 v-else class="mt-1 text-2xl font-bold">{{ tugas_belum }}</h1>
              <h4 class="mt-1 text-lg font-bold">Belum Dikumpulkan</h4>
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
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                />
              </svg>
            </div>
          </div>
        </div>
      </div>
      <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4 mt-4">
        <!-- <div
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
                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                <path
                  d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"
                />
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"
                />
              </svg>
            </div>
          </div>
        </div> -->
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
              <h1 v-else class="mt-1 text-2xl font-bold">{{ materi }}</h1>
              <h4 class="mt-1 text-lg font-bold">Materi</h4>
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
                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"
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
            bg-indigo-100
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
              <h1 v-else class="mt-1 text-2xl font-bold">{{ diskusi }}</h1>
              <h4 class="mt-1 text-lg font-bold">Diskusi</h4>
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
                  d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"
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

const loading = computed(() => store.state.students.loading);

const materi = computed(() => store.state.students.materi);
const tugas = computed(() => store.state.students.tugas);
const tugas_selesai = computed(() => store.state.students.tugas_selesai);
const tugas_belum = computed(() => store.state.students.tugas_belum);
const diskusi = computed(() => store.state.students.diskusi);
store.dispatch("getStudentDashboard");
</script>

<style>
</style>