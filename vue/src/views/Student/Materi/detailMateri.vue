<template>
  <div>
    <PageComponent>
      <template v-slot:header>
        <div class="flex justify-between items-center">
          <h1 class="text-3x1 font-bold text-gray-900">
            <router-link :to="{ name: 'StudentMateri' }">
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
            Materi dan Soal Evaluasi
          </h1>
        </div>
      </template>
      <div
        v-if="loading"
        class="justify-center shadow sm:rounded-md sm:overflow-hidden"
      >
        <div class="p-6 w-full mx-auto">
          <div
            class="mb-2 animate-pulse flex space-x-4"
            v-for="n in 7"
            :key="n"
          >
            <div class="flex-1 space-y-4 py-1">
              <div class="h-2 bg-slate-700 rounded"></div>
            </div>
          </div>
        </div>
      </div>
      <div v-else class="">
        <div class="shadow sm:rounded-md sm:overflow-hidden">
          <!-- Materi -->
          <h1 class="pl-6 pt-4 text-4xl font-medium">{{ model.title }}</h1>
          <p class="pl-6 pt-2">{{ model.created_at }}</p>
          <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
            <!-- Description -->
            <div>
              <label
                for="description"
                class="block text-sm font-medium text-gray-700"
                >{{ model.description }}</label
              >
            </div>
            <!--/ Description -->

            <!-- FIle -->
            <div>
              <label class="block text-sm font-medium text-gray-700">
                File
              </label>
              <div class="mt-1 flex items-center">
                <!-- <vue-pdf-embed :source="model.file" /> -->
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="
                    flex
                    items-center
                    justify-center
                    h-12
                    w-12
                    rounded-full
                    overflow-hidden
                    bg-gray-100
                  "
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                  />
                </svg>
                <button
                  type="button"
                  class="
                    relative
                    overflow-hidden
                    ml-5
                    bg-white
                    py-2
                    px-3
                    border border-gray-300
                    rounded-md
                    shadow-sm
                    text-sm
                    leading-4
                    font-medium
                    text-gray-700
                    hover:bg-gray-50
                    focus:outline-none
                    focus:ring-2
                    focus:ring-offset-2
                    focus:ring-indigo-500
                  "
                  @click.prevent="downloadFile(model.file)"
                >
                  <!-- <input
                      type="file"
                      
                      class="
                        absolute
                        left-0
                        top-0
                        right-0
                        bottom-0
                        opacity-0
                        cursor-pointer
                      "
                    /> -->
                  download
                </button>
              </div>
            </div>

            <!-- FIle -->

            <!-- Link -->
            <div>
              <label for="link" class="block text-sm font-medium text-gray-700"
                >Link Tambahan</label
              >
              <label
                for="link"
                class="block text-sm text-gray-700 text-justify"
                >{{ model.link }}</label
              >
            </div>
            <!--/ Link -->
          </div>
          <!--/ Materi -->
          <form
            v-if="model.status_pengerjaan == 'belum'"
            class="animate-fade-in-down row-span-3"
            @submit.prevent="sendEvaluation"
            enctype="multipart/form-data"
          >
            <!-- Soal Evaluasi -->
            <hr />
            <h1 class="pl-6 pt-4">Soal Evaluasi Pilihan Ganda</h1>
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <!-- Question -->
              <!-- Pertanyaan 1 -->
              <div>
                <label
                  for="question"
                  class="block text-sm font-medium text-gray-700"
                  >1. {{ model.question1 }}</label
                >
              </div>

              <!-- Jawaban Pertanyaan 1 -->
              <!-- Jawaban A Pertanyaan 1 -->
              <div>
                <label
                  for="link"
                  class="block text-sm font-medium text-gray-700"
                  >Jawab</label
                >
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <input
                      id="soal-1"
                      name="soal-1"
                      v-model="model.answer_1"
                      v-bind:value="model.jawaban_a_pertanyaan_1"
                      type="radio"
                      class="
                        focus:ring-indigo-500
                        h-4
                        w-4
                        text-indigo-600
                        border-gray-300
                      "
                    />
                  </div>
                  <div class="row row-span-2">
                    <label
                      for="link"
                      class="block mt-1 text-sm font-medium text-gray-700"
                      >A. {{ model.jawaban_a_pertanyaan_1 }}</label
                    >
                  </div>
                </div>
              </div>
              <!--/ Jawaban A Pertanyaan 1 -->

              <!-- Jawaban B Pertanyaan 1 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <input
                      id="soal-1"
                      name="soal-1"
                      v-model="model.answer_1"
                      v-bind:value="model.jawaban_b_pertanyaan_1"
                      type="radio"
                      class="
                        focus:ring-indigo-500
                        h-4
                        w-4
                        text-indigo-600
                        border-gray-300
                      "
                    />
                  </div>
                  <div class="row row-span-2">
                    <label
                      for="link"
                      class="block mt-1 text-sm font-medium text-gray-700"
                      >B. {{ model.jawaban_b_pertanyaan_1 }}</label
                    >
                  </div>
                </div>
              </div>
              <!--/ Jawaban B Pertanyaan 1 -->

              <!-- Jawaban C Pertanyaan 1 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <input
                      id="soal-1"
                      name="soal-1"
                      v-model="model.answer_1"
                      v-bind:value="model.jawaban_c_pertanyaan_1"
                      type="radio"
                      class="
                        focus:ring-indigo-500
                        h-4
                        w-4
                        text-indigo-600
                        border-gray-300
                      "
                    />
                  </div>
                  <div class="row mt-1 row-span-2">
                    <label
                      for="link"
                      class="block text-sm font-medium text-gray-700"
                      >C. {{ model.jawaban_c_pertanyaan_1 }}</label
                    >
                  </div>
                </div>
              </div>
              <!--/ Jawaban C Pertanyaan 1 -->

              <!-- Jawaban D Pertanyaan 1 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <input
                      id="soal-1"
                      name="soal-1"
                      v-model="model.answer_1"
                      v-bind:value="model.jawaban_d_pertanyaan_1"
                      type="radio"
                      class="
                        focus:ring-indigo-500
                        h-4
                        w-4
                        text-indigo-600
                        border-gray-300
                      "
                    />
                  </div>
                  <div class="row mt-1 row-span-2">
                    <label
                      for="link"
                      class="block text-sm font-medium text-gray-700"
                      >D. {{ model.jawaban_d_pertanyaan_1 }}</label
                    >
                  </div>
                </div>
              </div>
              <!--/ Jawaban D Pertanyaan 1 -->

              <!--/ Pertanyaan 1 -->

              <!-- Pertanyaan 2 -->
              <div>
                <label
                  for="question"
                  class="block text-sm font-medium text-gray-700"
                  >2. {{ model.question2 }}</label
                >
              </div>

              <!-- Jawaban Pertanyaan 2 -->
              <!-- Jawaban A Pertanyaan 2 -->
              <div>
                <label
                  for="link"
                  class="block text-sm font-medium text-gray-700"
                  >Jawab</label
                >
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <input
                      id="soal-2"
                      name="soal-2"
                      v-model="model.answer_2"
                      v-bind:value="model.jawaban_a_pertanyaan_2"
                      type="radio"
                      class="
                        focus:ring-indigo-500
                        h-4
                        w-4
                        text-indigo-600
                        border-gray-300
                      "
                    />
                  </div>
                  <div class="row row-span-2">
                    <label
                      for="link"
                      class="block mt-1 text-sm font-medium text-gray-700"
                      >A. {{ model.jawaban_a_pertanyaan_2 }}</label
                    >
                  </div>
                </div>
              </div>
              <!--/ Jawaban A Pertanyaan 2 -->

              <!-- Jawaban B Pertanyaan 2 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <input
                      id="soal-2"
                      name="soal-2"
                      v-model="model.answer_2"
                      v-bind:value="model.jawaban_b_pertanyaan_2"
                      type="radio"
                      class="
                        focus:ring-indigo-500
                        h-4
                        w-4
                        text-indigo-600
                        border-gray-300
                      "
                    />
                  </div>
                  <div class="row row-span-2">
                    <label
                      for="link"
                      class="block mt-1 text-sm font-medium text-gray-700"
                      >B. {{ model.jawaban_b_pertanyaan_2 }}</label
                    >
                  </div>
                </div>
              </div>
              <!--/ Jawaban B Pertanyaan 2 -->

              <!-- Jawaban C Pertanyaan 2 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <input
                      id="soal-2"
                      name="soal-2"
                      v-model="model.answer_2"
                      v-bind:value="model.jawaban_c_pertanyaan_2"
                      type="radio"
                      class="
                        focus:ring-indigo-500
                        h-4
                        w-4
                        text-indigo-600
                        border-gray-300
                      "
                    />
                  </div>
                  <div class="row mt-1 row-span-2">
                    <label
                      for="link"
                      class="block text-sm font-medium text-gray-700"
                      >C. {{ model.jawaban_c_pertanyaan_2 }}</label
                    >
                  </div>
                </div>
              </div>
              <!--/ Jawaban C Pertanyaan 2 -->

              <!-- Jawaban D Pertanyaan 2 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <input
                      id="soal-2"
                      name="soal-2"
                      v-model="model.answer_2"
                      v-bind:value="model.jawaban_d_pertanyaan_2"
                      type="radio"
                      class="
                        focus:ring-indigo-500
                        h-4
                        w-4
                        text-indigo-600
                        border-gray-300
                      "
                    />
                  </div>
                  <div class="row mt-1 row-span-2">
                    <label
                      for="link"
                      class="block text-sm font-medium text-gray-700"
                      >D. {{ model.jawaban_d_pertanyaan_2 }}</label
                    >
                  </div>
                </div>
              </div>
              <!--/ Jawaban D Pertanyaan 2 -->

              <!--/ Pertanyaan 2 -->

              <!-- Pertanyaan 3 -->
              <div>
                <label
                  for="question"
                  class="block text-sm font-medium text-gray-700"
                  >3. {{ model.question3 }}</label
                >
              </div>

              <!-- Jawaban Pertanyaan 3 -->
              <!-- Jawaban A Pertanyaan 3 -->
              <div>
                <label
                  for="link"
                  class="block text-sm font-medium text-gray-700"
                  >Jawab</label
                >
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <input
                      id="soal-3"
                      name="soal-3"
                      v-model="model.answer_3"
                      v-bind:value="model.jawaban_a_pertanyaan_3"
                      type="radio"
                      class="
                        focus:ring-indigo-500
                        h-4
                        w-4
                        text-indigo-600
                        border-gray-300
                      "
                    />
                  </div>
                  <div class="row row-span-2">
                    <label
                      for="link"
                      class="block mt-1 text-sm font-medium text-gray-700"
                      >A. {{ model.jawaban_a_pertanyaan_3 }}</label
                    >
                  </div>
                </div>
              </div>
              <!--/ Jawaban A Pertanyaan 3 -->

              <!-- Jawaban B Pertanyaan 3 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <input
                      id="soal-3"
                      name="soal-3"
                      v-model="model.answer_3"
                      v-bind:value="model.jawaban_b_pertanyaan_3"
                      type="radio"
                      class="
                        focus:ring-indigo-500
                        h-4
                        w-4
                        text-indigo-600
                        border-gray-300
                      "
                    />
                  </div>
                  <div class="row row-span-2">
                    <label
                      for="link"
                      class="block mt-1 text-sm font-medium text-gray-700"
                      >B. {{ model.jawaban_b_pertanyaan_3 }}</label
                    >
                  </div>
                </div>
              </div>
              <!--/ Jawaban B Pertanyaan 3 -->

              <!-- Jawaban C Pertanyaan 3 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <input
                      id="soal-3"
                      name="soal-3"
                      v-model="model.answer_3"
                      v-bind:value="model.jawaban_c_pertanyaan_3"
                      type="radio"
                      class="
                        focus:ring-indigo-500
                        h-4
                        w-4
                        text-indigo-600
                        border-gray-300
                      "
                    />
                  </div>
                  <div class="row mt-1 row-span-2">
                    <label
                      for="link"
                      class="block text-sm font-medium text-gray-700"
                      >C. {{ model.jawaban_c_pertanyaan_3 }}</label
                    >
                  </div>
                </div>
              </div>
              <!--/ Jawaban C Pertanyaan 3 -->

              <!-- Jawaban D Pertanyaan 3 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <input
                      id="soal-3"
                      name="soal-3"
                      v-model="model.answer_3"
                      v-bind:value="model.jawaban_d_pertanyaan_3"
                      type="radio"
                      class="
                        focus:ring-indigo-500
                        h-4
                        w-4
                        text-indigo-600
                        border-gray-300
                      "
                    />
                  </div>
                  <div class="row mt-1 row-span-2">
                    <label
                      for="link"
                      class="block text-sm font-medium text-gray-700"
                      >D. {{ model.jawaban_d_pertanyaan_3 }}</label
                    >
                  </div>
                </div>
              </div>
              <!--/ Jawaban D Pertanyaan 3 -->

              <!--/ Pertanyaan 3 -->

              <!--/ Question -->
            </div>
            <!--/ Soal Evaluasi -->

            <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
              <button
                type="submit"
                class="
                  inline-flex
                  justify-center
                  py-2
                  px-4
                  border border-transparent
                  shadow-sm
                  text-sm
                  font-medium
                  rounded-md
                  text-white
                  bg-indigo-600
                  hover:bg-indigo-700
                  focus:outline-none
                  focus:ring-2
                  focus:ring-offset-2
                  focus:ring-indigo-500
                "
              >
                Kirim
              </button>
            </div>
          </form>
        </div>
      </div>
    </PageComponent>
  </div>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import PageComponent from "../../../components/PageComponent.vue";
import { useRoute, useRouter } from "vue-router";
import store from "../../../store";
import VuePdfEmbed from "vue-pdf-embed";

const router = useRouter();

const route = useRoute();

let model = ref({
  id: "",
  materi_id: "",
  title: "",
  created_at: "",
  description: "",
  link: "",
  file: null,
  question1: "",
  question2: "",
  question3: "",
  jawaban_a_pertanyaan_1: "",
  jawaban_b_pertanyaan_1: "",
  jawaban_c_pertanyaan_1: "",
  jawaban_d_pertanyaan_1: "",
  jawaban_benar_pertanyaan_1: "",
  jawaban_a_pertanyaan_2: "",
  jawaban_b_pertanyaan_2: "",
  jawaban_c_pertanyaan_2: "",
  jawaban_d_pertanyaan_2: "",
  jawaban_benar_pertanyaan_2: "",
  jawaban_a_pertanyaan_3: "",
  jawaban_b_pertanyaan_3: "",
  jawaban_c_pertanyaan_3: "",
  jawaban_d_pertanyaan_3: "",
  jawaban_benar_pertanyaan_3: "",
  answer_1: "",
  answer_2: "",
  answer_3: "",
  status_pengerjaan: "",
});

watch(
  () => store.state.currentMateri.data,
  (newVal) => {
    model.value = {
      ...JSON.parse(JSON.stringify(newVal)),
      status: newVal.status !== "draft",
    };
  }
);

if (route.params.id) {
  store.dispatch("getStudentMateri", route.params.id);
}

const loading = computed(() => store.state.currentMateri.loading);

let answer = ref({
  id: "",
  materi_id: "",
  answer_1: "",
  answer_2: "",
  answer_3: "",
});

// var FormData = require("form-data");
function sendEvaluation() {
  if (
    answer.value.answer_1 == "" ||
    answer.value.answer_2 == "" ||
    answer.value.answer_3 == ""
  ) {
    store.commit("notify", {
      type: "failed",
      message: "seluruh jawaban wajib diisi",
    });
  } else {
    answer.value.id = model.value.id;
    answer.value.materi_id = model.value.materi_id;
    answer.value.answer_1 = model.value.answer_1;
    answer.value.answer_2 = model.value.answer_2;
    answer.value.answer_3 = model.value.answer_3;
    store.dispatch("sendEvalutionQuestion", answer.value).then(({ data }) => {
      store.commit("notify", {
        type: "success",
        message: "materi berhasil disimpan ",
      });
      store.dispatch("getStudentMateri", route.params.id);
    });
  }
}

// const url = `http://localhost:8000/${model.value.file}`;

function downloadFile(url) {
  console.log(url);
  window.open(url);
  //   document.getElementById("my_iframe").src = url;
}
</script>

<style>
</style>