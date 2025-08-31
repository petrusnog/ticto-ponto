import { router } from '@inertiajs/vue3'

const goTo = (routeName, method = 'GET', data = false) => {
    if (method == 'POST') {
        router.post(route(routeName, data));
    } else {
        router.get(route(routeName, data));
    }
}

export default goTo