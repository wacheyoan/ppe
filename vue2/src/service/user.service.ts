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
    },
    async getUserByEmail(email: string): Promise<User|null> {
        const rawUser = await userRepository.getUserByEmail(email);
        if(rawUser['hydra:member'][0]) {
            return userFactory.formatRawUserToUser(rawUser['hydra:member'][0]);
        }

        return null;
    },
    getBMR(user: User): number {
        const coeff = user.gender === "M" ? 5 : -161;
        return 10 * user.weight + 6.25 * user.height + 5 * this.getAge(user) + coeff;
    },
    getEntretien(user:User): number{
        return this.getBMR(user) * user.activity.coefficient;
    },
    getObjectiveCalorie(user:User): number
    {
        return this.getEntretien(user) - 1000;
    },
    getAge(user:User): number{
        const birthDate = new Date(user.birthDate);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }
}
