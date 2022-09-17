let inputs = [];

/**
 * Run any function on ready state of app
 * @param {function} fn callback
 */
 function ready(fn) {

    if (document.readyState !== "loading") {
        fn();
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

/**
 * Copy text to clipBoard
 *
 * @param {string} textToCopy
 */
function copyText(textToCopy,msg) {
    let myTemporaryInputElement = document.createElement("input");
    myTemporaryInputElement.type = "text";
    myTemporaryInputElement.value = textToCopy;

    document.body.appendChild(myTemporaryInputElement);

    myTemporaryInputElement.select();
    console.log(navigator.clipboard);
    if (typeof navigator.clipboard != 'undefined') {
        navigator.clipboard.writeText(textToCopy);
    }else{
        document.execCommand("copy");
    }

    document.body.removeChild(myTemporaryInputElement);
    window.$wireui.notify({
        description: msg,
        icon: 'success'
    });
}

/**
 * Initial regex for .only-digits selector
 */
 function onlyNumbers() {
    initOnly(".only-digits", /^\d*$/);
}

/**
 * Initial regex for .only-email selector
 */
function onlyEmail() {
    initOnly(".only-email", /^[a-zA-Z_0-9\.\-@]*$/);
}

/**
 * document.querySelector
 *
 * @param {string} querySelector
 * @return {Element}
 */
function getDom(querySelector){
    return document.querySelector(querySelector);
}

/**
 * Add callback to any event for element
 * @param {Event} e event
 * @param {Element} querySelector document element
 * @param {Function} callback function on event
 */
 function addEvent(e, querySelector, callback) {
    document.querySelector("body").addEventListener(
        e,
        (evt) => {
            let targetElement = evt.target;
            while (targetElement != null) {
                if (targetElement.matches(querySelector)) {
                    callback(evt);
                    return;
                }
                targetElement = targetElement.parentElement;
            }
        },
        true
    );
}

/**
 * Listen event for element
 * @param {Event|Event[]} event event
 * @param {Element} querySelector document element
 * @param {Function} callback function on event
 */
function onEvent(event, querySelector, callback) {
    if (Array.isArray(event)) {
        event.forEach((e) => {
            addEvent(e, querySelector, callback);
        });
    } else {
        addEvent(event, querySelector, callback);
    }
}

/**
 * Initial run Only regex definitions
 * @param {Element} element
 * @param {RegExp} regex
 */
function initOnly(element = "", regex = null) {
    onEvent(
        [
            "input",
            "keydown",
            "keyup",
            "mousedown",
            "mouseup",
            "select",
            "contextmenu",
            "drop",
        ],
        element,
        (el) => {
            el = el.target;

            if (regex.test(el.value)) {
                el.oldValue = el.value.replace(/(<([^>]+)>)/gi, "");
                el.oldSelectionStart = el.selectionStart;
                el.oldSelectionEnd = el.selectionEnd;
            } else if (el.hasOwnProperty("oldValue")) {
                el.value = el.oldValue.replace(/(<([^>]+)>)/gi, "");
                el.setSelectionRange(el.oldSelectionStart, el.oldSelectionEnd);
            } else {
                el.value = "";
            }
        }
    );
}

/**
 * Initial run for all input elements lock attrs
 * @param {Boolean} isReady
 */
 function initAttrs(isReady = false) {
    if (isReady) {
        inputs = [];
        document.querySelectorAll("input, textarea").forEach((element) => {
            let existId = element.id != "";
            if (existId) {
                inputs.push({
                    id: element.id,
                    max: element.maxLength > 1 ? element.maxLength : 100,
                });
            }
        });
    }

    inputs.forEach((input) => {
        onEvent(["input", "keypress", "drop", "paste"], "#" + input.id, (el) => {
            el = el.target;
            if (el.type != "file") {
                el.value = el.value.replace(/(<([^>]+)>)/gi, "");
                if (el.value.length > input.max) {
                    el.value = el.value.slice(0, input.max);
                    return false;
                }
            }
        });
    });
}

/**
 * Run events or event by querySelector
 *
 * @param {string[]|string} event
 * @param {Element|string} querySelector
 */
function runEvent(event, querySelector) {
    if (Array.isArray(event)) {
        event.forEach((e) => {
            callEvent(e, querySelector);
        });
    } else {
        callEvent(event, querySelector);
    }
}

/**
 * dispatch event from DOM
 *
 * @param {string} event
 * @param {Element|string} querySelector
 */
function callEvent(event, querySelector) {
    let e = null;
    if (isElement(querySelector)) {
        e = new Event(event,{bubbles:true,cancelable: event == 'submit' ? true :false})
        querySelector.dispatchEvent(e);
    }else{
        let elements = [...document.querySelectorAll(querySelector)]
        e = new Event(event,{bubbles:true,cancelable: event == 'submit' ? true :false})
        elements.forEach((el) => {
            el.dispatchEvent(e);
        });
    }
}

/**
 * Check if obj is a DOM Element
 *
 * @param {any} obj
 * @returns
 */
function isElement(obj) {
    try {
        return obj instanceof HTMLElement;
    } catch (e) {
        return (
            typeof obj === "object" &&
            obj.nodeType === 1 &&
            typeof obj.style === "object" &&
            typeof obj.ownerDocument === "object"
        );
    }
}

//Functions run on ready dom
ready(() => {
    onlyNumbers();
    onlyEmail();
    initAttrs(true);
    setTimeout(() => {
        Array.from(document.querySelectorAll('.intro-y')).forEach((el) => el.classList.remove('intro-y'));
        Array.from(document.querySelectorAll('.intro-x')).forEach((el) => el.classList.remove('intro-x'));
        Array.from(document.querySelectorAll('.-intro-x')).forEach((el) => el.classList.remove('-intro-x'));
    }, 500);
});
