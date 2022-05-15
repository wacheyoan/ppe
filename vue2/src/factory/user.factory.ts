import { User } from "@/interfaces/user.interface";

export default {
    formatRawUserToUser(rawUser: Readonly<any>): User {
        return {
            id: rawUser.id,
            email: rawUser.email,
            pseudo: rawUser.pseudo,
            height: rawUser.height,
            weight: rawUser.weight,
            phone: rawUser.phone,
            roles: rawUser.roles,
            createdAt: new Date(rawUser.createdAt)
        }
    }
}