import {UserInterface} from "@/scripts/types";

interface CanInterface {}

const can = (role: string, user: UserInterface, model: CanInterface): void => {
    // @ts-ignore
    const request = fetch(route('api/permissions', {
        user,
        role,
        model
    }))
    request.then((response) => response.json())
    request.then((data) => console.info(data))
}

export default can