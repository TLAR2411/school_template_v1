
const khmerDigits = ['០', '១', '២', '៣', '៤', '៥', '៦', '៧', '៨', '៩']

export function formatYear(value) {
    return String(value).replace(/\d/g, (digit) => khmerDigits[digit])
}