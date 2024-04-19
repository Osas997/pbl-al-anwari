@props(['placeholder' => 'default' , 'label' => 'default', 'type' => 'text'])


<div>
   <label class="mb-3 block text-sm font-medium text-black dark:text-white">
      {{ $label }}
   </label>
   <input {{ $attributes->merge(['type' => $type]) }} placeholder="{{ $placeholder }}"
   class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none
   transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter
   dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary" />
</div>