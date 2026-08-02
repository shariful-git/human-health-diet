<?php

namespace Tests\Unit;

use App\Services\HealthCalculator;
use PHPUnit\Framework\TestCase;

class HealthCalculatorTest extends TestCase
{
    public function test_calculate_bmi_returns_zero_for_invalid_input(): void
    {
        $this->assertEquals(0.0, HealthCalculator::calculateBmi(0, 170));
        $this->assertEquals(0.0, HealthCalculator::calculateBmi(70, 0));
        $this->assertEquals(0.0, HealthCalculator::calculateBmi(-70, 170));
    }

    public function test_calculate_bmi_returns_correct_value(): void
    {
        $bmi = HealthCalculator::calculateBmi(70, 175);
        $this->assertEquals(22.86, $bmi);
    }

    public function test_calculate_bmr_male_and_female(): void
    {
        $maleBmr = HealthCalculator::calculateBmr('male', 70, 175, 25);
        $femaleBmr = HealthCalculator::calculateBmr('female', 70, 175, 25);

        $this->assertEquals(1673, $maleBmr);
        $this->assertEquals(1507, $femaleBmr);
    }

    public function test_determine_calorie_target(): void
    {
        $targetLoss = HealthCalculator::determineCalorieTarget(2000, 'weight_loss');
        $targetGain = HealthCalculator::determineCalorieTarget(2000, 'weight_gain');
        $targetMaintain = HealthCalculator::determineCalorieTarget(2000, 'maintain');

        $this->assertEquals(1500, $targetLoss);
        $this->assertEquals(2500, $targetGain);
        $this->assertEquals(2000, $targetMaintain);
    }
}
