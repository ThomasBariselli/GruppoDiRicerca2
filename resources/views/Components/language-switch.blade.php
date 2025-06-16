<form action="{{ route('language.switch') }}"method="POST" class="inline-block">
    @csrf
    <select name="language" onchange="this.form.submit()" class="p-2 rounded bg-gray-100 text-gray-800">
        <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>Inglese</option>
        <option value="it" {{ app()->getLocale() === 'it' ? 'selected' : '' }}>Italiano</option>
        <option value="es" {{ app()->getLocale() === 'es' ? 'selected' : '' }}>Spagnolo</option>
    </select>
</form>