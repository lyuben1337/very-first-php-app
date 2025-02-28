import { format, parseISO } from "date-fns";

const dateFormatOptions = {
    short: "dd.MM.yyyy",
    long: "dd.MM.yyyy, HH:mm:ss",
} as const;

type DateFormat = keyof typeof dateFormatOptions;

export const formatDate = (
    dateString: string,
    formatType: DateFormat = "long",
): string => {
    try {
        const date = parseISO(dateString);
        const formatPattern = dateFormatOptions[formatType];
        return format(date, formatPattern);
    } catch {
        return "Invalid Date";
    }
};
