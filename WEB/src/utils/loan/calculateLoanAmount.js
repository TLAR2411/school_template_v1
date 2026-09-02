/**
 * A helper function to round a numeric value up to the nearest specified multiple.
 * @param {number} value The number to round.
 * @param {number} nearest The multiple to round up to.
 * @returns {number} The rounded number.
 */
const roundUpToNearest = (value, nearest) => {
    // If 'nearest' is not a positive number, default to standard Math.ceil to avoid errors.
    if (!nearest || nearest <= 0) {
        return Math.ceil(value);
    }
    return Math.ceil(value / nearest) * nearest;
};

/**
 * Calculates various loan amounts based on user input and loan duration settings.
 * This is a pure function that returns an object with the calculated values.
 */
function calculateLoanAmount(totalLoanAmount, roundRange, loanDurations, DurationId, totalInterestRate = null) {
    // Find the loan duration settings based on the selected ID.
    const selectedDuration = loanDurations?.find(
        (v) => v.id == DurationId
    ) || {};

    // Get numeric values from the form, providing fallbacks to prevent NaN errors.
    const loanAmount = parseFloat(totalLoanAmount) || 0;
    const roundingValue = parseFloat(roundRange) || 0;

    // A condition is met if a duration setting is found and a loan amount is entered.
    const canCalculate = selectedDuration && loanAmount > 0;

    // Use 'let' because these variables will be reassigned.
    let interestAmount = 0;
    let loanFeeAmount = 0;
    let depositAmount = 0;
    let penaltyAmount = 0;
    let perScheduleAmount = 0;
    let insuranceAmount = 0;
    let interestRate = 0;

    if (canCalculate) {
        // Destructure properties from the selected duration for easier access, with defaults.
        const {
            interest_rate = 0,
            loan_fee_rate = 0,
            deposit_rate = 0,
            penalty_rate = 0,
            penalty_amount = 0,
            insurance_amount = 0,
            duration = 1, // Use 1 as a fallback to prevent division by zero.
        } = selectedDuration;

        let interestRate = 0;

        if (totalInterestRate != null) {
            console.log(totalInterestRate);

            interestRate = totalInterestRate
        }

        // Helper to calculate a value from a percentage rate of the loan amount.
        const calculateFromRate = (rate) => (loanAmount * rate) / 100;

        // --- Perform Calculations ---
        interestAmount = roundUpToNearest(calculateFromRate(interestRate), roundingValue);
        loanFeeAmount = roundUpToNearest(calculateFromRate(loan_fee_rate), roundingValue);
        depositAmount = roundUpToNearest(calculateFromRate(deposit_rate), roundingValue);

        // Handle penalty logic: prioritize rate over fixed amount.
        if (penalty_rate > 0) {

            if (loanAmount < 1000000) {
                penaltyAmount = roundUpToNearest((1000000 * penalty_rate) / 100);
            } else {
                penaltyAmount = roundUpToNearest(calculateFromRate(penalty_rate), roundingValue);
            }

        } else {
            penaltyAmount = penalty_amount;
        }

        // CORRECTED: Use the local 'interestAmount' variable, not 'formData'.
        const totalPrincipalAndInterest = loanAmount + interestAmount;
        const perScheduleRaw = totalPrincipalAndInterest / duration;
        perScheduleAmount = roundUpToNearest(perScheduleRaw, roundingValue);

        insuranceAmount = roundUpToNearest(insurance_amount, roundingValue);
        interestRate = interestRate;
    }

    // Return a new object with all the calculated values.
    console.log({
        interestAmount, // Shorthand for 'interestAmount': interestAmount
        loanFeeAmount,
        depositAmount,
        penaltyAmount,
        perScheduleAmount,
        insuranceAmount,
        interestRate,
    });

    return {
        interestAmount, // Shorthand for 'interestAmount': interestAmount
        loanFeeAmount,
        depositAmount,
        penaltyAmount,
        perScheduleAmount,
        insuranceAmount,
        interestRate,
    };
}

// The original export statement
export default calculateLoanAmount;