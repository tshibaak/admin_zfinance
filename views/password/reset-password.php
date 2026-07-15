<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer le mot de passe</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-lg">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-700 to-indigo-600 p-8 text-center">
                <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 15v2m6-8V7a6 6 0 10-12 0v2M5 9h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2v-8a2 2 0 012-2z" />
                    </svg>
                </div>

                <h1 class="text-2xl font-bold text-white">
                    Changer le mot de passe
                </h1>

                <p class="text-blue-100 mt-2">
                    Choisissez un mot de passe sécurisé pour protéger votre compte.
                </p>
            </div>

            <!-- Form -->
            <form class="p-8 space-y-6">

                <!-- Ancien mot de passe -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                     Address email
                    </label>

                    <div class="relative">
                        <input
                            type="email"
                            placeholder="exemple@gmai.com"
                            class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>

                <!-- Nouveau mot de passe -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nouveau mot de passe
                    </label>

                    <input
                        type="password"
                        placeholder="********"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">

                    <!-- Barre de sécurité -->
                    <div class="mt-3">
                        <div class="w-full h-2 bg-gray-200 rounded-full">
                            <div class="h-2 w-2/3 bg-green-500 rounded-full"></div>
                        </div>

                        <p class="text-sm text-green-600 mt-2">
                            Mot de passe fort
                        </p>
                    </div>
                </div>

                <!-- Confirmation -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Confirmer le mot de passe
                    </label>

                    <input
                        type="password"
                        placeholder="********"
                        class="w-full rounded-xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Conseils -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <h3 class="font-semibold text-blue-700 mb-2">
                        Votre mot de passe doit contenir :
                    </h3>

                    <ul class="space-y-1 text-sm text-gray-700">
                        <li>✔ Au moins 8 caractères</li>
                        <li>✔ Une lettre majuscule</li>
                        <li>✔ Une lettre minuscule</li>
                        <li>✔ Un chiffre</li>
                        <li>✔ Un caractère spécial (@, #, $, %, ...)</li>
                    </ul>
                </div>

                <!-- Boutons -->
                <div class="flex gap-4 pt-2">

                    <button
                        type="button"
                        class="w-1/2 border border-gray-300 text-gray-700 py-3 rounded-xl hover:bg-gray-100 transition">
                        Annuler
                    </button>

                    <button
                        type="submit"
                        class="w-1/2 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition shadow-lg">
                        Mettre à jour
                    </button>

                </div>

            </form>

        </div>
    </div>

</body>
</html>