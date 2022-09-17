import axios from "axios";

document.addEventListener("alpine:init", () => {
    /**
     * Alpine global app
     */
    Alpine.data("app", () => ({
        getThemeFromLocalStorage() {
            // if user already changed the theme, use it
            if (window.localStorage.getItem("dark")) {
                return JSON.parse(window.localStorage.getItem("dark"));
            }
            // else return their preferences
            return (
                !!window.matchMedia &&
                window.matchMedia("(prefers-color-scheme: dark)").matches
            );
        },
        setThemeToLocalStorage: (value) => {
            window.localStorage.setItem("dark", value);
        },
        dark: false,
        loading: true,
        toggleTheme: {
            ["@click"]() {
                this.dark = !this.dark;
                this.setThemeToLocalStorage(this.dark);
            },
        },
        init() {
            this.dark = this.getThemeFromLocalStorage();
            let _this = this;
            // Add a request interceptor
            window.axios.interceptors.request.use(
                function (config) {
                    _this.loading = true;
                    return config;
                },
                function (error) {
                    _this.loading = false;
                    return Promise.reject(error);
                }
            );

            // Add a response interceptor
            window.axios.interceptors.response.use(
                function (response) {
                    _this.loading = false;
                    return response;
                },
                function (error) {
                    _this.loading = false;
                    return Promise.reject(error);
                }
            );
        },
    }));

    /**
     * Alpine navbar interation
     */
    Alpine.data("navbar", () => ({
        open: false,

        toggle() {
            this.open = !this.open;
        },
    }));

    /**
     * Alpine products data
     */
    Alpine.data("productsData", () => ({
        products: [],
        currentProduct: {
            name:'',
            price:'',
        },
        async init() {
            await axios
                .get("products")
                .then(({ data }) => {
                    this.products = data.data;
                    let productId = new URLSearchParams(location.search).get(
                        "product"
                    );
                    this.currentProduct = this.filterProduct(productId);
                })
                .catch((error) => {
                    this.products = [];
                });
            onEvent('change','#product',()=>{
                this.currentProduct = this.filterProduct(
                    getDom("#product").value
                );
            })
            let _this = this;
            window.addEventListener("popstate", function () {
                _this.currentProduct = _this.filterProduct(
                    getDom("#product").value
                );
            });
        },
        filterProduct(productId) {
            return (
                this.products.find((product) => product.id == productId) ?? {
                    name:'',
                    price:'',
                }
            );
        },
    }));

    /**
     * Alpine orders data
     */
    Alpine.data("ordersData", () => ({
        orders: [],
        async init() {
            await axios
                .get("order")
                .then(({ data }) => {
                    this.orders = data.data;
                })
                .catch((error) => {
                    this.orders = [];
                });
        },
    }));

    /**
     * Alpine select
     */
    Alpine.data("select", (queryParam = "") => ({
        queryParam:
            new URLSearchParams(location.search).get(queryParam) || null,
        popstate: false,
        init() {
            if (queryParam) {
                this.$watch("queryParam", (value) => {
                    if (!this.popstate) {
                        const url = new URL(window.location.href);
                        url.searchParams.set(queryParam, value);
                        history.pushState(null, document.title, url.toString());
                    }
                    this.popstate = false;
                });
                let _this = this;
                window.addEventListener("popstate", function () {
                    _this.popstate = true;
                    _this.queryParam = new URLSearchParams(location.search).get(
                        queryParam
                    );
                });
            }
        },
    }));

    /**
     * Alpine order process
     */
    Alpine.data("orderProcess",(orderId)=> ({
        orderId: orderId,
        async getCheckout() {
            await axios
                .post("order",{
                    id: this.orderId
                })
                .then(({ data }) => {
                    console.log(data.data);
                    window.location.href = data.data.processUrl
                })
                .catch((error) => {
                    console.log(error);
                });
        }
    }));
});
