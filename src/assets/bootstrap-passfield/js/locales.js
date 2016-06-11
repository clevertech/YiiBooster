/**
 * @license Pass*Field | (c) 2013 Antelle | https://github.com/antelle/passfield/blob/master/MIT-LICENSE.txt
 */

// Permission is hereby granted, free of charge, to any person obtaining
// a copy of this software and associated documentation files (the
// "Software"), to deal in the Software without restriction, including
// without limitation the rights to use, copy, modify, merge, publish,
// distribute, sublicense, and/or sell copies of the Software, and to
// permit persons to whom the Software is furnished to do so, subject to
// the following conditions:

// The above copyright notice and this permission notice shall be
// included in all copies or substantial portions of the Software.

// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
// EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
// MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
// NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
// LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
// OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
// WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

/**
 * Entry point
 * Initializes PassField
 * If jQuery is present, sets jQuery plugin ($.passField)
 */
(function($, document, window) {
    "use strict";

    var PassField = window.PassField = window.PassField || {};
    PassField.Config = PassField.Config || {};

    PassField.Config.locales = {
        en: {
            lower: true,
                msg: {
                pass: "password",
                    and: "and",
                    showPass: "Show password",
                    hidePass: "Hide password",
                    genPass: "Random password",
                    passTooShort: "password is too short (min. length: {})",
                    noCharType: "password must contain {}",
                    digits: "digits",
                    letters: "letters",
                    lettersUp: "letters in UPPER case",
                    symbols: "symbols",
                    inBlackList: "password is in list of top used passwords",
                    passRequired: "password is required",
                    equalTo: "password is equal to login",
                    repeat: "password consists of repeating characters",
                    badChars: "password contains bad characters: “{}”",
                    weakWarn: "weak",
                    invalidPassWarn: "*",
                    weakTitle: "This password is weak",
                    generateMsg: "To generate a strong password, click {} button."
            }
        },
        de: {
            lower: false,
                msg: {
                pass: "Passwort",
                    and: "und",
                    showPass: "Passwort anzeigen",
                    hidePass: "Passwort verbergen",
                    genPass: "Zufallspasswort",
                    passTooShort: "Passwort ist zu kurz (Mindestlänge: {})",
                    noCharType: "Passwort muss {} enthalten",
                    digits: "Ziffern",
                    letters: "Buchstaben",
                    lettersUp: "Buchstaben in GROSSSCHRIFT",
                    symbols: "Symbole",
                    inBlackList: "Passwort steht auf der Liste der beliebtesten Passwörter",
                    passRequired: "Passwort wird benötigt",
                    equalTo: "Passwort ist wie Anmeldung",
                    repeat: "Passwort besteht aus sich wiederholenden Zeichen",
                    badChars: "Passwort enthält ungültige Zeichen: “{}”",
                    weakWarn: "Schwach",
                    invalidPassWarn: "*",
                    weakTitle: "Dieses Passwort ist schwach",
                    generateMsg: "Klicken Sie auf den {}-Button, um ein starkes Passwort zu generieren."
            },
            blackList: ["passwort"]
        },
        fr: {
            lower: true,
                msg: {
                pass: "mot de passe",
                    and: "et",
                    showPass: "Montrer le mot de passe",
                    hidePass: "Cacher le mot de passe",
                    genPass: "Mot de passe aléatoire",
                    passTooShort: "le mot de passe est trop court (min. longueur: {})",
                    noCharType: "le mot de passe doit contenir des {}",
                    digits: "chiffres",
                    letters: "lettres",
                    lettersUp: "lettres en MAJUSCULES",
                    symbols: "symboles",
                    inBlackList: "le mot de passe est dans la liste des plus utilisés",
                    passRequired: "le mot de passe est requis",
                    equalTo: "le mot de passe est le même que l'identifiant",
                    repeat: "le mot de passe est une répétition de caractères",
                    badChars: "le mot de passe contient des caractères incorrects: “{}”",
                    weakWarn: "faible",
                    invalidPassWarn: "*",
                    weakTitle: "Ce mot de passe est faible",
                    generateMsg: "Pour créer un mot de passe fort cliquez sur le bouton {}."
            }
        },
        it: {
            lower: false,
                msg: {
                pass: "password",
                    and: "e",
                    showPass: "Mostra password",
                    hidePass: "Nascondi password",
                    genPass: "Password casuale",
                    passTooShort: "la password è troppo breve (lunghezza min.: {})",
                    noCharType: "la password deve contenere {}",
                    digits: "numeri",
                    letters: "lettere",
                    lettersUp: "lettere in MAIUSCOLO",
                    symbols: "simboli",
                    inBlackList: "la password è nella lista delle password più usate",
                    passRequired: "è necessaria una password",
                    equalTo: "la password è uguale al login",
                    repeat: "la password è composta da caratteri che si ripetono",
                    badChars: "la password contiene caratteri non accettati: “{}”",
                    weakWarn: "debole",
                    invalidPassWarn: "*",
                    weakTitle: "Questa password è debole",
                    generateMsg: "Per generare una password forte, clicca sul tasto {}."
            }
        },
        nl: {
            lower: true,
                msg: {
                pass: "wachtwoord",
                    and: "en",
                    showPass: "Toon wachtwoord",
                    hidePass: "Verberg wachtwoord",
                    genPass: "Willekeurig wachtwoord",
                    passTooShort: "Wachtwoord is te kort (min. lengte: {})",
                    noCharType: "wachtwoord moet {} bevatten",
                    digits: "cijfers",
                    letters: "letters",
                    lettersUp: "hoofdletters",
                    symbols: "symbolen",
                    inBlackList: "wachtwoord is in de lijst meest gebruikte wachtwoorden",
                    passRequired: "wachtwoord is verplicht",
                    equalTo: "wachtwoord is hetzelfde als login",
                    repeat: "wachtwoord bestaat uit herhaalde karakters",
                    badChars: "wachtwoord bevat verboden karakters: “{}”",
                    weakWarn: "zwak",
                    invalidPassWarn: "*",
                    weakTitle: "Dit wachtwoord is zwak",
                    generateMsg: "Klik {} om een sterk wachtwoord te genereren."
            }
        },
        ru: {
            lower: true,
                msg: {
                pass: "пароль",
                    and: "и",
                    showPass: "Показать пароль",
                    hidePass: "Скрыть пароль",
                    genPass: "Случайный пароль",
                    passTooShort: "пароль слишком короткий (мин. длина: {})",
                    noCharType: "в пароле должны быть {}",
                    digits: "цифры",
                    letters: "буквы",
                    lettersUp: "буквы в ВЕРХНЕМ регистре",
                    symbols: "символы",
                    inBlackList: "этот пароль часто используется в Интернете",
                    passRequired: "пароль обязателен",
                    equalTo: "пароль совпадает с логином",
                    repeat: "пароль состоит из повторяющихся символов",
                    badChars: "в пароле есть недопустимые символы: «{}»",
                    weakWarn: "слабый",
                    invalidPassWarn: "*",
                    weakTitle: "Пароль слабый, его легко взломать",
                    generateMsg: "Чтобы сгенерировать пароль, нажмите кнопку {}."
            },
            blackList: ["пароль", "секрет"]
        },
        sv: {
            lower: true,
                msg: {
                pass: "lösenord",
                    and: "och",
                    showPass: "Visa lösenord",
                    hidePass: "Göm lösenord",
                    genPass: "Slumpad lösenord",
                    passTooShort: "lösenordet är för kort (min. längd: {})",
                    noCharType: "lösenordet måste innehålla {}",
                    digits: "nummer",
                    letters: "bokstäver",
                    lettersUp: "kapital bokstäver",
                    symbols: "symboler",
                    inBlackList: "lösenordet är med i dem mest använda lösenord",
                    passRequired: "lösenord är nödvändigt",
                    equalTo: "lösenordet är desamma som användarnamnet",
                    repeat: "lösenordet innehåller samma tecken",
                    badChars: "lösenordet innehåller förbjudna symboler: “{}”",
                    weakWarn: "svag",
                    invalidPassWarn: "*",
                    weakTitle: "Detta lösenord ät för svag",
                    generateMsg: "För ett starkare lösenord klicka {}."
            }
        },
        ua: {
            lower: true,
                msg: {
                pass: "пароль",
                    and: "i",
                    showPass: "Показати пароль",
                    hidePass: "Сховати пароль",
                    genPass: "Випадковий пароль",
                    passTooShort: "пароль є занадто коротким (мiн. довжина: {})",
                    noCharType: "пароль повинен містити {}",
                    digits: "цифри",
                    letters: "букви",
                    lettersUp: "букви у ВЕРХНЬОМУ регістрі",
                    symbols: "cимволи",
                    inBlackList: "пароль входить до списку паролей, що використовуються найчастіше",
                    passRequired: "пароль є обов'язковим",
                    equalTo: "пароль та логін однакові",
                    repeat: "пароль містить повторювані символи",
                    badChars: "пароль містить неприпустимі символи: «{}»",
                    weakWarn: "слабкий",
                    invalidPassWarn: "*",
                    weakTitle: "Цей пароль є слабким",
                    generateMsg: "Щоб ​​створити надійний пароль, натисніть кнопку {}."
            }
        },
        es: {
            lower: true,
                msg: {
                pass: "contraseña",
                    and: "y",
                    showPass: "Mostrar contraseña",
                    hidePass: "Ocultar contraseña",
                    genPass: "Contraseña aleatoria",
                    passTooShort: "contraseña demasiado corta (longitud mín.: {})",
                    noCharType: "la contraseña debe contener {}",
                    digits: "dígitos",
                    letters: "letras",
                    lettersUp: "letras en MAYÚSCULAS",
                    symbols: "símbolos",
                    inBlackList: "la contraseña está en la lista de las contraseñas más usadas",
                    passRequired: "se requiere contraseña",
                    equalTo: "la contraseña es igual al inicio de sesión",
                    repeat: "la contraseña tiene caracteres repetidos",
                    badChars: "la contraseña contiene caracteres no permitidos: “{}”",
                    weakWarn: "débil",
                    invalidPassWarn: "*",
                    weakTitle: "Esta contraseña es débil",
                    generateMsg: "Para generar una contraseña segura, haga clic en el botón de {}."
            }
        },
        el: {
            lower: true,
                msg: {
                pass: "πρόσβασης",
                    and: "και",
                    showPass: "Προβολή κωδικού πρόσβασης",
                    hidePass: "Απόκρυψη κωδικού πρόσβασης",
                    genPass: "Τυχαίος κωδικός πρόσβασης",
                    passTooShort: "ο κωδικός πρόσβασης είναι πολύ μικρός (ελάχιστο μήκος: {})",
                    noCharType: "ο κωδικός πρόσβασης πρέπει να περιέχει {}",
                    digits: "ψηφία",
                    letters: "λατινικά γράμματα",
                    lettersUp: "λατινικά γράμματα με ΚΕΦΑΛΑΙΑ",
                    symbols: "σύμβολα",
                    inBlackList: "ο κωδικός πρόσβασης βρίσκεται σε κατάλογο δημοφιλέστερων κωδικών",
                    passRequired: "απαιτείται κωδικός πρόσβασης",
                    equalTo: "ο κωδικός είναι όμοιος με το όνομα χρήστη",
                    repeat: "ο κωδικός αποτελείται από επαναλαμβανόμενους χαρακτήρες",
                    badChars: "ο κωδικός περιέχει μη επιτρεπτούς χαρακτήρες: “{}”",
                    weakWarn: "αδύναμος",
                    invalidPassWarn: "*",
                    weakTitle: "Αυτός ο κωδικός πρόσβασης είναι αδύναμος",
                    generateMsg: "Για να δημιουργήσετε δυνατό κωδικό πρόσβασης, κάντε κλικ στο κουμπί {}."
            }
        },
        pt: {
            lower: true,
                msg: {
                pass: "senha",
                    and: "e",
                    showPass: "Mostrar senha",
                    hidePass: "Ocultar senha",
                    genPass: "Senha aleatória",
                    passTooShort: "senha muito curta (tamanho mínimo: {})",
                    noCharType: "Senha deve conter {}",
                    digits: "dígito",
                    letters: "letras",
                    lettersUp: "letras maiúsculas",
                    symbols: "símbolos",
                    inBlackList: "senha está na lista das senhas mais usadas",
                    passRequired: "senha é obrigatória",
                    equalTo: "senha igual ao login",
                    repeat: "senha consiste em uma repetição de caracteres",
                    badChars: "senha tem caracteres inválidos: “{}”",
                    weakWarn: "fraca",
                    invalidPassWarn: "*",
                    weakTitle: "Esta senha é fraca",
                    generateMsg: "Para gerar uma senha forte, clique no botão {}."
            }
        }
    };
})(window.jQuery, document, window);
