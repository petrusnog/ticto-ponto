import { router } from '@inertiajs/vue3'

const goTo = (routeName, method = 'GET') => {
    if (method == 'POST') {
        router.post(route(routeName));
    } else {
        router.get(route(routeName));
    }
}

export default goTo