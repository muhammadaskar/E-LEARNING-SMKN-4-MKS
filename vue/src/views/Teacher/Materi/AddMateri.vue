<template>
  <div>
    <PageComponent>
      <template v-slot:header>
        <div class="flex justify-between items-center">
          <h1 class="text-3x1 font-bold text-gray-900">
            <router-link :to="{ name: 'TeacherMateri' }">
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
      <div class="grid grid-cols-2 gap-2">
        <div class="mt-12">
          <img
            src="https://img.freepik.com/free-vector/teacher-character-collection_23-2148517110.jpg?w=2000"
          />
        </div>
        <form
          class="animate-fade-in-down row-span-3"
          @submit.prevent="saveMateri"
          enctype="multipart/form-data"
        >
          <div class="shadow sm:rounded-md sm:overflow-hidden">
            <!-- Materi -->
            <h1 class="pl-6 pt-4">Materi</h1>
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <!-- Title -->
              <div>
                <label
                  for="title"
                  class="block text-sm font-medium text-gray-700"
                  >Judul</label
                >
                <input
                  type="text"
                  name="title"
                  v-model="model.title"
                  id="title"
                  autocomplete="title"
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
              <!--/ Title -->

              <!-- Description -->
              <div>
                <label
                  for="description"
                  class="block text-sm font-medium text-gray-700"
                  >Deskripsi</label
                >
                <textarea
                  id="description"
                  name="description"
                  v-model="model.description"
                  rows="3"
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
              <!--/ Description -->

              <!-- FIle -->
              <div>
                <label class="block text-sm font-medium text-gray-700">
                  File
                </label>
                <div class="mt-1 flex items-center">
                  <svg
                    v-if="model.file"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M5 13l4 4L19 7"
                    />
                  </svg>
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
                  >
                    <input
                      type="file"
                      @change="onChange"
                      class="
                        absolute
                        left-0
                        top-0
                        right-0
                        bottom-0
                        opacity-0
                        cursor-pointer
                      "
                    />
                    ganti
                  </button>
                </div>
              </div>

              <!-- FIle -->

              <!-- Link -->
              <div>
                <label
                  for="link"
                  class="block text-sm font-medium text-gray-700"
                  >Link Tambahan</label
                >
                <input
                  type="text"
                  name="link"
                  v-model="model.link"
                  id="link"
                  autocomplete="link"
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
              <!--/ Link -->
            </div>
            <!--/ Materi -->

            <!-- Soal Evaluasi -->
            <hr />
            <h1 class="pl-6 pt-4">Soal Evaluasi Pilihan Ganda</h1>
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
              <!-- Question -->
              <div>
                <label
                  for="question"
                  class="block text-sm font-medium text-gray-700"
                  >Pertanyaan 1</label
                >
                <textarea
                  id="question"
                  name="question"
                  v-model="model.question1"
                  rows="3"
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

              <!-- Jawaban Pertanyaan 1 -->
              <!-- Jawaban A Pertanyaan 1 -->
              <div>
                <label
                  for="link"
                  class="block text-sm font-medium text-gray-700"
                  >Jawaban soal nomor 1</label
                >
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <label
                      for="link"
                      class="block text-sm font-medium text-gray-700"
                      >A</label
                    >
                  </div>
                  <div class="row row-span-2 pl-3.5">
                    <input
                      type="text"
                      name="jawaban_a_pertanyaan_1"
                      v-model="model.jawaban_a_pertanyaan_1"
                      id="jawaban_a_pertanyaan_1"
                      autocomplete="jawaban_a_pertanyaan_1"
                      class="
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
                </div>
              </div>
              <!--/ Jawaban A Pertanyaan 1 -->

              <!-- Jawaban B Pertanyaan 1 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <label
                      for="link"
                      class="block text-sm font-medium text-gray-700"
                      >B</label
                    >
                  </div>
                  <div class="row row-span-2 pl-3.5">
                    <input
                      type="text"
                      name="jawaban_a_pertanyaan_1"
                      v-model="model.jawaban_b_pertanyaan_1"
                      id="jawaban_a_pertanyaan_1"
                      autocomplete="jawaban_a_pertanyaan_1"
                      class="
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
                </div>
              </div>
              <!--/ Jawaban B Pertanyaan 1 -->

              <!-- Jawaban C Pertanyaan 1 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <label
                      for="link"
                      class="block text-sm font-medium text-gray-700"
                      >C</label
                    >
                  </div>
                  <div class="row row-span-2 pl-3.5">
                    <input
                      type="text"
                      name="jawaban_c_pertanyaan_1"
                      v-model="model.jawaban_c_pertanyaan_1"
                      id="jawaban_c_pertanyaan_1"
                      autocomplete="jawaban_c_pertanyaan_1"
                      class="
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
                </div>
              </div>
              <!--/ Jawaban C Pertanyaan 1 -->

              <!-- Jawaban D Pertanyaan 1 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <label
                      for="link"
                      class="block text-sm font-medium text-gray-700"
                      >D</label
                    >
                  </div>
                  <div class="row row-span-2 pl-3.5">
                    <input
                      type="text"
                      name="jawaban_d_pertanyaan_1"
                      v-model="model.jawaban_d_pertanyaan_1"
                      id="jawaban_d_pertanyaan_1"
                      autocomplete="jawaban_d_pertanyaan_1"
                      class="
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
                </div>
              </div>
              <!--/ Jawaban D Pertanyaan 1 -->

              <!-- Jawaban Benar Pertanyaan 1 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-6 w-6"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="2"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"
                      />
                    </svg>
                  </div>
                  <div class="row row-span-2 pr-6">
                    <select
                      id="jawaban_benar_1"
                      name="jawaban_benar_1"
                      autocomplete="jawaban_benar_1"
                      v-model="model.jawaban_benar_pertanyaan_1"
                      class="
                        block
                        w-full
                        border border-gray-300
                        bg-white
                        rounded-md
                        shadow-sm
                        focus:outline-none
                        focus:ring-indigo-500
                        focus:border-indigo-500
                        sm:text-sm
                      "
                    >
                      <option selected>Jawaban Benar</option>
                      <option :value="model.jawaban_a_pertanyaan_1">A</option>
                      <option :value="model.jawaban_b_pertanyaan_1">B</option>
                      <option :value="model.jawaban_c_pertanyaan_1">C</option>
                      <option :value="model.jawaban_d_pertanyaan_1">D</option>
                    </select>
                  </div>
                </div>
              </div>
              <!--/ Jawaban Benar Pertanyaan 1 -->

              <!--/ Pertanyaan 1 -->

              <!--/ Pertanyaan 2 -->
              <div>
                <label
                  for="question"
                  class="block text-sm font-medium text-gray-700"
                  >Pertanyaan 2</label
                >
                <textarea
                  id="question"
                  name="question"
                  v-model="model.question2"
                  rows="3"
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

              <!-- Jawaban Pertanyaan 2 -->
              <!-- Jawaban A Pertanyaan 2 -->
              <div>
                <label
                  for="link"
                  class="block text-sm font-medium text-gray-700"
                  >Jawaban soal nomor 2</label
                >
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <label
                      for="link"
                      class="block text-sm font-medium text-gray-700"
                      >A</label
                    >
                  </div>
                  <div class="row row-span-2 pl-3.5">
                    <input
                      type="text"
                      name="jawaban_a_pertanyaan_1"
                      v-model="model.jawaban_a_pertanyaan_2"
                      id="jawaban_a_pertanyaan_2"
                      autocomplete="jawaban_a_pertanyaan_2"
                      class="
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
                </div>
              </div>
              <!--/ Jawaban A Pertanyaan 2 -->

              <!-- Jawaban B Pertanyaan 2 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <label
                      for="link"
                      class="block text-sm font-medium text-gray-700"
                      >B</label
                    >
                  </div>
                  <div class="row row-span-2 pl-3.5">
                    <input
                      type="text"
                      name="jawaban_a_pertanyaan_2"
                      v-model="model.jawaban_b_pertanyaan_2"
                      id="jawaban_a_pertanyaan_2"
                      autocomplete="jawaban_a_pertanyaan_2"
                      class="
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
                </div>
              </div>
              <!--/ Jawaban B Pertanyaan 2 -->

              <!-- Jawaban C Pertanyaan 2 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <label
                      for="link"
                      class="block text-sm font-medium text-gray-700"
                      >C</label
                    >
                  </div>
                  <div class="row row-span-2 pl-3.5">
                    <input
                      type="text"
                      name="jawaban_c_pertanyaan_2"
                      v-model="model.jawaban_c_pertanyaan_2"
                      id="jawaban_c_pertanyaan_2"
                      autocomplete="jawaban_c_pertanyaan_2"
                      class="
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
                </div>
              </div>
              <!--/ Jawaban C Pertanyaan 2 -->

              <!-- Jawaban D Pertanyaan 2 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <label
                      for="link"
                      class="block text-sm font-medium text-gray-700"
                      >D</label
                    >
                  </div>
                  <div class="row row-span-2 pl-3.5">
                    <input
                      type="text"
                      name="jawaban_d_pertanyaan_2"
                      v-model="model.jawaban_d_pertanyaan_2"
                      id="jawaban_d_pertanyaan_2"
                      autocomplete="jawaban_d_pertanyaan_2"
                      class="
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
                </div>
              </div>
              <!--/ Jawaban D Pertanyaan 2 -->

              <!-- Jawaban Benar Pertanyaan 2 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-6 w-6"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="2"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"
                      />
                    </svg>
                  </div>
                  <div class="row row-span-2 pr-6">
                    <select
                      id="jawaban_benar_pertanyaan_2"
                      name="jawaban_benar_pertanyaan_2"
                      autocomplete="jawaban_benar_pertanyaan_2"
                      v-model="model.jawaban_benar_pertanyaan_2"
                      class="
                        block
                        w-full
                        border border-gray-300
                        bg-white
                        rounded-md
                        shadow-sm
                        focus:outline-none
                        focus:ring-indigo-500
                        focus:border-indigo-500
                        sm:text-sm
                      "
                    >
                      <option selected>Jawaban Benar</option>
                      <option :value="model.jawaban_a_pertanyaan_2">A</option>
                      <option :value="model.jawaban_b_pertanyaan_2">B</option>
                      <option :value="model.jawaban_c_pertanyaan_2">C</option>
                      <option :value="model.jawaban_d_pertanyaan_2">D</option>
                    </select>
                  </div>
                </div>
              </div>
              <!--/ Jawaban Benar Pertanyaan 2 -->
              <!--/ Jawaban Pertanyaan 2 -->

              <!--/ Pertanyaan 2 -->

              <div>
                <label
                  for="question"
                  class="block text-sm font-medium text-gray-700"
                  >Pertanyaan 3</label
                >
                <textarea
                  id="question"
                  name="question"
                  v-model="model.question3"
                  rows="3"
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

              <!-- Jawaban Pertanyaan 3 -->
              <!-- Jawaban A Pertanyaan 3 -->
              <div>
                <label
                  for="link"
                  class="block text-sm font-medium text-gray-700"
                  >Jawaban soal nomor 3</label
                >
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <label
                      for="link"
                      class="block text-sm font-medium text-gray-700"
                      >A</label
                    >
                  </div>
                  <div class="row row-span-2 pl-3.5">
                    <input
                      type="text"
                      name="jawaban_a_pertanyaan_3"
                      v-model="model.jawaban_a_pertanyaan_3"
                      id="jawaban_a_pertanyaan_3"
                      autocomplete="jawaban_a_pertanyaan_3"
                      class="
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
                </div>
              </div>
              <!--/ Jawaban A Pertanyaan 3 -->

              <!-- Jawaban B Pertanyaan 3 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <label
                      for="link"
                      class="block text-sm font-medium text-gray-700"
                      >B</label
                    >
                  </div>
                  <div class="row row-span-2 pl-3.5">
                    <input
                      type="text"
                      name="jawaban_a_pertanyaan_3"
                      v-model="model.jawaban_b_pertanyaan_3"
                      id="jawaban_a_pertanyaan_3"
                      autocomplete="jawaban_a_pertanyaan_3"
                      class="
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
                </div>
              </div>
              <!--/ Jawaban B Pertanyaan 3 -->

              <!-- Jawaban C Pertanyaan 3 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <label
                      for="link"
                      class="block text-sm font-medium text-gray-700"
                      >C</label
                    >
                  </div>
                  <div class="row row-span-2 pl-3.5">
                    <input
                      type="text"
                      name="jawaban_c_pertanyaan_3"
                      v-model="model.jawaban_c_pertanyaan_3"
                      id="jawaban_c_pertanyaan_3"
                      autocomplete="jawaban_c_pertanyaan_3"
                      class="
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
                </div>
              </div>
              <!--/ Jawaban C Pertanyaan 3 -->

              <!-- Jawaban D Pertanyaan 3 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <label
                      for="link"
                      class="block text-sm font-medium text-gray-700"
                      >D</label
                    >
                  </div>
                  <div class="row row-span-2 pl-3.5">
                    <input
                      type="text"
                      name="jawaban_d_pertanyaan_3"
                      v-model="model.jawaban_d_pertanyaan_3"
                      id="jawaban_d_pertanyaan_3"
                      autocomplete="jawaban_d_pertanyaan_3"
                      class="
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
                </div>
              </div>
              <!--/ Jawaban D Pertanyaan 3 -->

              <!-- Jawaban Benar Pertanyaan 3 -->
              <div>
                <div class="grid grid-rows-2 grid-flow-col gap-2 justify-start">
                  <div class="row row-span-2">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-6 w-6"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="2"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"
                      />
                    </svg>
                  </div>
                  <div class="row row-span-2 pr-6">
                    <select
                      id="jawaban_benar_pertanyaan_3"
                      name="jawaban_benar_pertanyaan_3"
                      autocomplete="jawaban_benar_pertanyaan_3"
                      v-model="model.jawaban_benar_pertanyaan_3"
                      class="
                        block
                        w-full
                        border border-gray-300
                        bg-white
                        rounded-md
                        shadow-sm
                        focus:outline-none
                        focus:ring-indigo-500
                        focus:border-indigo-500
                        sm:text-sm
                      "
                    >
                      <option selected>Jawaban Benar</option>
                      <option :value="model.jawaban_a_pertanyaan_3">A</option>
                      <option :value="model.jawaban_b_pertanyaan_3">B</option>
                      <option :value="model.jawaban_c_pertanyaan_3">C</option>
                      <option :value="model.jawaban_d_pertanyaan_3">D</option>
                    </select>
                  </div>
                </div>
              </div>
              <!--/ Jawaban Benar Pertanyaan 3 -->
              <!--/ Jawaban Pertanyaan 3 -->

              <!--/ Question -->
            </div>
            <!--/ Soal Evaluasi -->

            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
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
                Simpan
              </button>
            </div>
          </div>
        </form>
      </div>
    </PageComponent>
  </div>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import PageComponent from "../../../components/PageComponent.vue";
import { useRoute, useRouter } from "vue-router";
import store from "../../../store";
import axios from "../../../axios";

const router = useRouter();

const route = useRoute();

let model = ref({
  title: "",
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
});

function onChange(e) {
  const file = e.target.files[0];
  model.value.file = file;
  console.log(model.value.file);
}

function saveMateri() {
  let fd = new FormData();
  fd.append("title", model.value.title);
  fd.append("description", model.value.description);
  fd.append("link", model.value.link);
  fd.append("file", model.value.file);
  fd.append("question1", model.value.question1);
  fd.append("question2", model.value.question2);
  fd.append("question3", model.value.question3);
  fd.append("jawaban_a_pertanyaan_1", model.value.jawaban_a_pertanyaan_1);
  fd.append("jawaban_b_pertanyaan_1", model.value.jawaban_b_pertanyaan_1);
  fd.append("jawaban_c_pertanyaan_1", model.value.jawaban_c_pertanyaan_1);
  fd.append("jawaban_d_pertanyaan_1", model.value.jawaban_d_pertanyaan_1);
  fd.append(
    "jawaban_benar_pertanyaan_1",
    model.value.jawaban_benar_pertanyaan_1
  );
  fd.append("jawaban_a_pertanyaan_2", model.value.jawaban_a_pertanyaan_2);
  fd.append("jawaban_b_pertanyaan_2", model.value.jawaban_b_pertanyaan_2);
  fd.append("jawaban_c_pertanyaan_2", model.value.jawaban_c_pertanyaan_2);
  fd.append("jawaban_d_pertanyaan_2", model.value.jawaban_d_pertanyaan_2);
  fd.append(
    "jawaban_benar_pertanyaan_2",
    model.value.jawaban_benar_pertanyaan_2
  );
  fd.append("jawaban_a_pertanyaan_3", model.value.jawaban_a_pertanyaan_3);
  fd.append("jawaban_b_pertanyaan_3", model.value.jawaban_b_pertanyaan_3);
  fd.append("jawaban_c_pertanyaan_3", model.value.jawaban_c_pertanyaan_3);
  fd.append("jawaban_d_pertanyaan_3", model.value.jawaban_d_pertanyaan_3);
  fd.append(
    "jawaban_benar_pertanyaan_3",
    model.value.jawaban_benar_pertanyaan_3
  );
  store.dispatch("saveTeacherMateri", fd).then(({ data }) => {
    store.commit("notify", {
      type: "success",
      message: "materi berhasil disimpan ",
    });
    router.push({
      name: "TeacherMateri",
    });
  });
}
</script>

<style>
</style>