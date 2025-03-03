<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>{{$title}}</title>
</head>
<body class="bg-gray-900 text-white" x-data="{ modal: false, modalHeader : 'Header', modalBody: 'Body', modalAction: '' }">

    <div class="mx-4">
        {{$slot}}
    </div>

    <x-delete-modal></x-delete-modal>

</body>
</html>