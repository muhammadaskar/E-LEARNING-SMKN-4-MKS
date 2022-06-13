<template>
  <div>
    <PageComponent>
      <template v-slot:header>
        <div class="flex justify-between items-center">
          <h1 class="text-3x1 font-bold text-gray-900">
            <router-link :to="{ name: 'TeacherAssignment' }">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-5 w-5 inline-block"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path
                  fill-rule="evenodd"
                  d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                  clip-rule="evenodd"
                /></svg
            ></router-link>
            Tugas
          </h1>
        </div>
      </template>
      <div class="grid grid-cols-2 gap-2">
        <div class="mt-12">
          <img
            src="https://img.freepik.com/free-vector/teacher-character-collection_23-2148517110.jpg?w=2000"
          />
        </div>
        <form
          class="animate-fade-in-down row-span-3"
          enctype="multipart/form-data"
        >
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <!-- Tugas Fields -->
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <!-- TITLE -->
              <div>
                <label
                  for="title"
                  class="block text-sm font-medium text-gray-700"
                  >Judul tugas</label
                >
                <input
                  disabled
                  type="text"
                  name="title"
                  id="title"
                  autocomplete="title"
                  v-model="model.title"
                  class="
                    mt-1
                    focus:ring-indigo-500 focus:border-indigo-500
                    block
                    w-full
                    shadow-sm
                    sm:text-sm
                    border-gray-300
                    rounded-md
                  "
                />
              </div>
              <!--/ TITLE -->

              <!-- DESKRIPSI -->
              <div>
                <label
                  for="description"
                  class="block text-sm font-medium text-gray-700"
                  >Deskripsi</label
                >
                <textarea
                  disabled
                  id="description"
                  name="description"
                  rows="3"
                  v-model="model.description"
                  class="
                    shadow-sm
                    focus:ring-indigo-500 focus:border-indigo-500
                    mt-1
                    block
                    w-full
                    sm:text-sm
                    border border-gray-300
                    rounded-md
                  "
                />
              </div>
              <!--/ DESKRIPSI -->

              <!-- DUE DATE -->
              <div>
                <label
                  for="description"
                  class="block text-sm font-medium text-gray-700"
                  >Tenggang waktu</label
                >
                <Datepicker
                  disabled
                  v-model="model.due_date"
                  :minDate="new Date()"
                ></Datepicker>
              </div>
              <!--/ DUE DATE -->
            </div>
            <!--/ Tugas Fields -->
          </div>
        </form>
      </div>

      <h1>Tugas Siswa</h1>

      <div v-if="loadingStudentAssignments" class="justify-center">
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

      <!-- List Assignment -->
      <div
        v-else
        class="relative overflow-x-auto shadow-md sm:rounded-lg p-4"
        v-for="studentAssignment in studentAssignments"
        :key="studentAssignment"
      >
        <div class="flex flex-row">
          <div class="">
            <img
              class="h-8 w-8 mt-2 rounded-full"
              :src="'https://www.kindpng.com/picc/m/78-785827_user-profile-avatar-login-account-male-user-icon.png'"
              alt=""
            />
          </div>
          <div class="basis-5/6 pl-4">
            <h1>{{ studentAssignment.name }}</h1>
            <!-- <div class="">{{ studentAssignment.id }}</div> -->
          </div>
          <div class="pt-3 pl-5">
            <router-link
              :to="{
                name: 'TeacherAssignmentResult',
                params: { id: studentAssignment.id },
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
              >detail</router-link
            >
          </div>
        </div>
      </div>
      <!-- End List Assignment -->
    </PageComponent>
  </div>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import PageComponent from "../../../components/PageComponent.vue";
import { useRoute, useRouter } from "vue-router";
import store from "../../../store";

import Datepicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

const router = useRouter();

const route = useRoute();

let model = ref({
  title: "",
  description: "",
  due_date: "",
});

watch(
  () => store.state.currentAssignment.data,
  (newVal) => {
    model.value = {
      ...JSON.parse(JSON.stringify(newVal)),
      status: newVal.status !== "draft",
    };
  }
);
const studentAssignments = computed(() => store.state.student_assignments.data);

const loadingStudentAssignments = computed(
  () => store.state.student_assignments.loading
);

if (route.params.id) {
  store.dispatch("detailTeacherAssignment", route.params.id);
}
</script>

<style>
</style>