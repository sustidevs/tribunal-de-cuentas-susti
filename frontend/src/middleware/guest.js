export default function guest({ next, store }) {
    if (store.getters.authenticated) {
        next("/")
    } else {
        next();
    }
}