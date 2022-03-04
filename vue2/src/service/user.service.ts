import userRepository from "@/repository/user.repository";
import userFactory from "@/factory/user.factory";
import {User} from "@/interfaces/user.interface";

export default {
    async getAllUsers(): Promise<User[]> {
        const rawUsers = await userRepository.getAllusers();
        const users: User[] = [];
        rawUsers['hydra:member'].forEach((rawUser: any) => {
            users.push(userFactory.formatRawUserToUser(rawUser));
        })
        return users;
    }
}